<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User as ModelsUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SignupController extends Controller
{
    public function index()
    {
        return view('frontpage.signup', [
            'title' => 'Daftar Akun',
        ]);
    }

    public function ubahPasswordView()
    {
        return view('frontpage.ubahpassword', [
            'title' => 'Ubah Password',
        ]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Password saat ini tidak sesuai!');
        }

        ModelsUser::where('id', $user->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', 'Password berhasil diubah!');
    }

    public function tutorial()
    {
        return view('frontpage.tutorial-chat-id', [
            'title' => 'Tutorial Chat ID Telegram',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_induk' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'nomor_telegram' => 'required|string|max:255',
            'chat_id' => 'required|string|max:255',
            'roles_id' => 'required|integer',
            'kelas' => 'nullable|string|max:255',
            'foto_profil' => 'nullable|image|max:1024', // 1MB Max
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Pengecekan akun yang sama berdasarkan nama, nomor_induk, dan email
        $existingUser = ModelsUser::where('nama', $request->nama)->where('nomor_induk', $request->nomor_induk)->where('email', $request->email)->first();

        if ($existingUser) {
            return redirect('/signup')->with('error', 'Akun dengan nama, nomor induk, dan email yang sama sudah terdaftar.');
        }

        $fotoPath = null;

        if ($request->hasFile('foto_profil')) {
            $extension = $request->file('foto_profil')->getClientOriginalExtension();
            $fotoPath = $request->file('foto_profil')->storeAs('fotoprofil', $request->nama . '-' . $request->nomor_induk . '.' . $extension, 'public');
        }

        ModelsUser::create([
            'nama' => $request->nama,
            'nomor_induk' => $request->nomor_induk,
            'alamat' => $request->alamat,
            'nomor_telegram' => $request->nomor_telegram,
            'chat_id' => $request->chat_id,
            'roles_id' => $request->roles_id,
            'kelas' => $request->kelas,
            'foto_profil' => $fotoPath,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status_akun' => 'inactive',
        ]);

        return redirect('/login')->with('success', 'Akun berhasil dibuat. Silakan login.');
    }
}
