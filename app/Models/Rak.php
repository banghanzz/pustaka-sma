<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rak extends Model
{
    use HasFactory;

    protected $table = 'rak';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $incrementing = false;

    public function buku()
    {
        return $this->hasMany(Buku::class, 'rak_id');
    }
}
