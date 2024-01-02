<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class SellerModel extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table= 'seller';
    protected $fillable = [
        'nama', 'email', 'password', 'jenis_kelamin', 'no_telp', 'tanggal_lahir', 'nik', 'foto_ktp', 'foto_wajah', 'alamat_lengkap', 'kodepos','profesi','status_verifikasi','id_province', 'id_cities', 'id_district','id_subdistrict'
    ];

    protected $hidden = [
        'password',
    ];

    public function toko()
    {
        return $this->hasOne(TokoModel::class);
    }

    public function provinces()
    {
        return $this->belongsTo(ProvincesModel::class, 'id_province', 'prov_id');
    }

    public function cities()
    {
        return $this->belongsTo(CitiesModel::class, 'id_cities', 'city_id');
    }

    public function district()
    {
        return $this->belongsTo(DistrictsModel::class, 'id_district', 'dis_id');
    }

    public function subdistrict()
    {
        return $this->belongsTo(SubDistrictsModel::class, 'id_district', 'subdis_id');
    }

}
