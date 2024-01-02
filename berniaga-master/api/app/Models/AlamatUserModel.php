<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlamatUserModel extends Model
{
    use HasFactory;
    protected $table= 'alamat_user';
    protected $guard = 'alamat_user';
    protected $fillable = [
        'provinsi','kota','kodepos','alamat_lengkap','id_user'
    ];
}
