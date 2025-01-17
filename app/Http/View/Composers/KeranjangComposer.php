<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;

class KeranjangComposer
{
    public function compose(View $view)
    {
        $keranjang = Keranjang::where('users_id', Auth::id())->where('status_keranjang', 'pending')->first();
        $keranjangCount = $keranjang ? $keranjang->detailPeminjaman->count() : 0;

        $view->with('keranjangCount', $keranjangCount);
    }
}