<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Varian1Model extends Model
{
    use HasFactory;
    protected $table = 'varian1';
    protected $guard = 'varian1';
    protected $fillable = [
        'nama_varian', 'id_tipe_varian'
    ];
}
