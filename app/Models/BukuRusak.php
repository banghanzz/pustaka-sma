<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BukuRusak extends Model
{
    use HasFactory;

    protected $table = 'buku_rusak';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $incrementing = false;

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }
}
