<?php

namespace App\Http\Controllers\Lokasi;

use App\Http\Controllers\Controller;
use App\Models\DistrictsModel;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class DistrictsController extends Controller
{
    public function index($id_city, $id = null)
    {
        if ($id === null) {
            $districts = DistrictsModel::where('city_id', $id_city)->get();
        } else {
            $districts = DistrictsModel::where('city_id', $id_city)->find($id);
        }
        $response = [
            'status' => true,
            'message' => 'Data Kecamatan',
            'data' => $districts,
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }
}
