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
        return view('frontpage.login',[
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
            $request->session()->regenerate();

            $user = Auth::user();

            Keranjang::firstOrCreate(
                ['users_id' => $user->id, 'status_keranjang' => 'pending'],
                ['created_at' => now(), 'updated_at' => now()]
            );

            if ($user->roles_id == 1 || $user->roles_id == 999) {
                return redirect('/admin/dashboard')->with('success', 'Login berhasil');
            } else {
                return redirect('/')->with('success', 'Login berhasil');
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
