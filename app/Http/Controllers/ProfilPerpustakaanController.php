<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilPerpustakaanController extends Controller
{
    public function index()
    {
        return view('frontpage.profilpustaka',[
            'title' => 'Profil Perpustakaan',
        ]);
    }
}
