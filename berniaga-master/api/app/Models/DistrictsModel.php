<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistrictsModel extends Model
{
    use HasFactory;
    protected $table = 'districts';

    public function cities()
    {
        return $this->hasMany(CitiesModel::class);
    }
    public function subdistrict()
    {
        return $this->belongsTo(SubdistrictModel::class);
    }

    public function seller()
    {
        return $this->hasMany(SellerModel::class);
    }
}
