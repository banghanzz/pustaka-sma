<?php

namespace App\Http\Controllers;

use App\Models\TataTertib;
use Illuminate\Http\Request;

class TataTertibController extends Controller
{
    public function index()
    {
        return view('frontpage.tatatertib',[
            'title' => 'Tata Tertib',
            'tata_tertib' => TataTertib::all(),
        ]);
    }
}
