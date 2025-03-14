<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Keranjang;

class LoginController extends Controller
{
    public function index()
    {
        return view('frontpage.login', [
            'title' => 'Login ke Perpustakaan SMAN 3 Tualang',
        ]);
    }

    public function loginPost(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Check if account is inactive
            if ($user->status_akun !== 'active') {
                Auth::logout();
                return back()->with('error', 'Akun Anda belum diaktifkan. Silahkan hubungi admin.');
            }

            $request->session()->regenerate();

            Keranjang::firstOrCreate(['users_id' => $user->id, 'status_keranjang' => 'pending'], ['created_at' => now(), 'updated_at' => now()]);

            if ($user->roles_id == 1 || $user->roles_id == 999) {
                return redirect('/admin/dashboard')->with('success', 'Login berhasil');
            } else {
                return redirect('/koleksi-buku')->with('success', 'Login berhasil');
            }
        }

        return back()->with('error', 'Email atau Password salah, silahkan coba lagi');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logout berhasil');
    }
}
