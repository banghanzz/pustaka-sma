<?php

namespace App\Http\Controllers;

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
        $keranjang = Keranjang::firstOrCreate(
            ['users_id' => Auth::id(), 'status_keranjang' => 'pending'],
            ['created_at' => now(), 'updated_at' => now()]
        );
        
        $totalBuku = DetailPeminjaman::where('keranjang_id', $keranjang->id)->sum('jumlah');

        if ($totalBuku >= 2) {
            return redirect()->back()->with('error', 'Anda hanya bisa meminjam maksimal 2 buku.');
        }

        try {
            DetailPeminjaman::create([
            'keranjang_id' => $keranjang->id,
            'buku_id' => $request->buku_id,
            'jumlah' => '1',
            'status_peminjaman' => 'keranjang',
            ]);
        } catch (\Exception $e) {
            return redirect('/koleksi-buku');
        }

        return redirect()->back()->with('success', 'Buku berhasil ditambahkan ke keranjang.');
    }

    public function removeFromKeranjang($id)
    {
        $detailPeminjaman = DetailPeminjaman::find($id);
        $detailPeminjaman->delete();

        return redirect()->back()->with('success', 'Buku berhasil dihapus dari keranjang.');
    }

    public function ajukanPinjaman(Request $request)
    {
        $keranjang = Keranjang::where('users_id', Auth::id())->where('status_keranjang', 'pending')->first();

        if ($keranjang) {
            $tanggalPinjam = $request->input('tanggal_pinjam');
            $tanggalKembali = date('Y-m-d', strtotime($tanggalPinjam . ' +3 days'));

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
