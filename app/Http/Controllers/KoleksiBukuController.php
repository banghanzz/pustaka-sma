<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class KoleksiBukuController extends Controller
{
    public function index()
    {
        return view('koleksi-buku.index',[
            'title' => 'Koleksi Buku',
        ]);
    }
}
