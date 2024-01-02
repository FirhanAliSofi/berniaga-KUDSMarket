<?php

namespace App\Http\Controllers\Lokasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProvincesModel;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class ProvinceController extends Controller
{
    public function index($id = null)
    {
        if ($id === null) {
            $province = ProvincesModel::get();
        } else {
            $province = ProvincesModel::find($id);
        }
        $response = [
            'status' => true,
            'message' => 'Data Provinsi',
            'data' => $province,
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }
}
