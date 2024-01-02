<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CitiesModel extends Model
{
    use HasFactory;
    protected $table = 'cities';

    public function province()
    {
        return $this->hasMany(ProvincesModel::class);
    }
    
    public function district()
    {
        return $this->belongsTo(DistrictModel::class);
    }

    public function seller()
    {
        return $this->hasMany(SellerModel::class);
    }
}
