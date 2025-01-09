<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TataTertib extends Model
{
    use HasFactory;

    protected $table = 'tata_tertib';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $incrementing = false;
}
