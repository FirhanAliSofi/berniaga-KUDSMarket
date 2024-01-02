<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokModel extends Model
{
    use HasFactory;
    protected $table = 'stok';
    protected $guard = 'stok';
    protected $fillable = [
        'id_produk', 'id_varian1', 'id_varian2', 'stok', 'harga', 'berat', 'status'
    ];
}
