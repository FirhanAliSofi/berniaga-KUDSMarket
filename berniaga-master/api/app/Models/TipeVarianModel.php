<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeVarianModel extends Model
{
    use HasFactory;

    protected $table= 'tipe_varian';
    protected $guard = 'tipe_varian';
    protected $fillable = [
        'nama_tipe'
    ];
}
