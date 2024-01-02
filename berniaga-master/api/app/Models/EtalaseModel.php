<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtalaseModel extends Model
{
    use HasFactory;
    protected $table= 'etalase';
    protected $guard = 'etalase';
    protected $fillable = [
        'nama_etalase','foto_etalase','id_toko'
    ];
}
