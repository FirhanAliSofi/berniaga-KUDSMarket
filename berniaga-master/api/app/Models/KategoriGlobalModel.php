<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriGlobalModel extends Model
{
    use HasFactory;

    protected $table= 'kategori_global';
    protected $guard = 'kategori_global';
    protected $fillable = [
        'nama_kategori'
    ];
}
