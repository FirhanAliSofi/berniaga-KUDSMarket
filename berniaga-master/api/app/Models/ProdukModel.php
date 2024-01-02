<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukModel extends Model
{
    use HasFactory;
    protected $table= 'produk';
    protected $fillable = [
        'nama_produk', 'merek', 'kondisi', 'deskripsi_produk', 'link_produk', 'foto_produk1', 'foto_produk2', 'foto_produk3', 'status_varian','panjang', 'lebar', 'tinggi', 'id_toko', 'id_etalase', 'id_kategori'
    ];
}
