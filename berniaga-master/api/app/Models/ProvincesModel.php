<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProvincesModel extends Model
{
    use HasFactory;
    protected $table = 'provinces';
    protected $fillable = [
        'prov_id', 'prov_name'
    ];

    public function cities()
    {
        return $this->hasMany(CitiesModel::class);
    }

    public function seller()
    {
        return $this->hasMany(SellerModel::class);
    }

    public function provinces()
    {
        return $this->hasMany(ProvincesModel::class, 'prov_id');
    }
}
