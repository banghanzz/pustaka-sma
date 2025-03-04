<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use App\Models\DetailPeminjaman;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    public function index()
    {
        $keranjang = Keranjang::where('users_id', Auth::id())->where('status_keranjang', 'pending')->first();
        $detailPeminjaman = $keranjang ? $keranjang->detailPeminjaman : collect([]);

        return view('frontpage.keranjang', [
            'title' => 'Keranjang',
            'keranjang' => $keranjang,
            'detailPeminjaman' => $detailPeminjaman,
        ]);
    }

    public function addToKeranjang(Request $request)
    {
        try {
            // Tambahkan validasi request
            if (!$request->buku_id) {
                throw new \Exception('ID Buku tidak ditemukan.');
            }

            // Buat atau ambil keranjang yang ada dengan data lengkap
            $keranjang = Keranjang::firstOrCreate(
                [
                    'users_id' => Auth::id(),
                    'status_keranjang' => 'pending',
                ],
                [
                    'users_id' => Auth::id(),
                    'status_keranjang' => 'pending',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            );

            // Refresh instance keranjang untuk memastikan data terbaru
            $keranjang = $keranjang->fresh();

            // Cek total buku di keranjang
            $totalBuku = DetailPeminjaman::where('keranjang_id', $keranjang->id)->sum('jumlah');

            // Akun Siswa hanya dapat meminjam maksimal 2 buku
            if (Auth::user()->roles_id == 4) {
                // Siswa
                if ($totalBuku >= 2) {
                    return redirect()->back()->with('error', 'Siswa hanya bisa meminjam maksimal 2 buku.');
                }
            }

            // Tambahkan buku ke keranjang dengan data lengkap
            DetailPeminjaman::create([
                'keranjang_id' => $keranjang->id,
                'buku_id' => $request->buku_id,
                'jumlah' => '1',
                'status_peminjaman' => 'keranjang',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->back()->with('success', 'Buku berhasil ditambahkan ke keranjang.');

        } catch (\Exception $e) {
            Log::error('Error adding to cart: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menambahkan buku ke keranjang. Silakan coba lagi.');
        }
    }

    public function removeFromKeranjang($id)
    {
        $detailPeminjaman = DetailPeminjaman::find($id);
        $detailPeminjaman->delete();

        return redirect()->back()->with('success', 'Buku berhasil dihapus dari keranjang.');
    }

    public function ajukanPinjaman(Request $request)
    {
        // Validasi sederhana
        $request->validate([
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after:tanggal_pinjam',
        ]);

        $keranjang = Keranjang::where('users_id', Auth::id())->where('status_keranjang', 'pending')->first();

        if ($keranjang) {
            $tanggalPinjam = $request->input('tanggal_pinjam');
            $tanggalKembali = $request->input('tanggal_kembali');

            foreach ($keranjang->detailPeminjaman as $detail) {
                $nomorPinjaman = 'PNJM' . Auth::id() . $tanggalPinjam . $detail->buku_id;

                $detail->update([
                    'tanggal_pinjam' => $tanggalPinjam,
                    'tanggal_kembali' => $tanggalKembali,
                    'status_peminjaman' => 'menunggu',
                    'nomor_pinjaman' => $nomorPinjaman,
                ]);
            }

            return redirect()->back()->with('success', 'Pengajuan peminjaman berhasil. Silahkan hubungi Pustakawan untuk meminta persetujuan.');
        }

        return redirect()->back()->with('error', 'Keranjang tidak ditemukan.');
    }
}
