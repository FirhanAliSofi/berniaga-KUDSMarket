<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Varian2Model extends Model
{
    use HasFactory;
    protected $table = 'varian2';
    protected $guard = 'varian2';
    protected $fillable = [
        'nama_varian', 'id_tipe_varian'
    ];
}
