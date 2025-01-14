<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KartuPerpustakaanController extends Controller
{
    public function index()
    {
        return view('frontpage.kartuperpustakaan',[
            'title' => 'Kartu Perpustakaan',
        ]);
    }
}
