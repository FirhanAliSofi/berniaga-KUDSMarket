<?php

namespace App\Http\Controllers\Lokasi;

use App\Http\Controllers\Controller;
use App\Models\CitiesModel;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class CitiesController extends Controller
{
    public function index($id_province, $id = null)
    {
        if ($id === null) {
            $cities = CitiesModel::where('prov_id', $id_province)->get();
        } else {
            $cities = CitiesModel::where('prov_id', $id_province)->find($id);
        }
        $response = [
            'status' => true,
            'message' => 'Data Kota',
            'data' => $cities,
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }
}
