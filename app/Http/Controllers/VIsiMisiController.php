<?php

namespace App\Http\Controllers;

use App\Models\VIsiMisi;
use Illuminate\Http\Request;

class VIsiMisiController extends Controller
{
    public function index()
    {
        return view('frontpage.visimisi',[
            'title' => 'Visi & Misi',
            'visi_misi' => VIsiMisi::all(),
        ]);
    }
}
