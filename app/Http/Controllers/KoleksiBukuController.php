<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class KoleksiBukuController extends Controller
{
    public function index()
    {
        return view('frontpage.koleksibuku',[
            'title' => 'Koleksi Buku',
        ]);
    }
}
