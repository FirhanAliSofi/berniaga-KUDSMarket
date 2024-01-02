<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubDistrictsModel extends Model
{
    use HasFactory;
    protected $table = 'subdistricts';

    public function district()
    {
        return $this->hasMany(DistrictModel::class);
    }

    public function seller()
    {
        return $this->hasMany(SellerModel::class);
    }
}
