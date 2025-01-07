<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $incrementing = false;

    public function buku()
    {
        return $this->hasMany(Buku::class, 'kategori_id');
    }
}
