<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class keranjang extends Model
{
    use HasFactory;

    protected $table = 'keranjang';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $incrementing = false;

    public function detailPeminjaman()
    {
        return $this->hasMany(DetailPeminjaman::class, 'keranjang_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

}
