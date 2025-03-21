<?php

namespace App\Http\Controllers;

use App\Models\VisiMisi;
use Illuminate\Http\Request;

class VisiMisiController extends Controller
{
    public function index()
    {
        return view('frontpage.visimisi',[
            'title' => 'Visi & Misi',
            'visi_misi' => VisiMisi::all(),
        ]);
    }

    public function adminView()
    {
        return view('adminpage.visimisi',[
            'title' => 'Visi & Misi',
        ]);
    }
}
