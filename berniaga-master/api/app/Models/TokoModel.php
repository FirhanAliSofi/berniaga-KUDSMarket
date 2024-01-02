<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class TokoModel extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table= 'toko';
    protected $guard = 'toko';
    protected $fillable = [
        'nama_toko', 'alamat_toko', 'link_toko','no_telp_toko','id_province','id_cities','id_district','id_subdistrict','kodepos','alamat','jam_buka','jam_tutup','jenis_usaha','logo_toko','foto_toko1','foto_toko2','foto_toko3','deskripsi','status','saldo','id_seller',
    ];
    public function seller()
    {
        return $this->belongsTo(SellerModel::class);
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
