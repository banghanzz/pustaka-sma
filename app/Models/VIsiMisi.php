<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VIsiMisi extends Model
{
    use HasFactory;

    protected $table = 'visi_misi';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $incrementing = false;
}
