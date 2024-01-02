<?php

namespace App\Http\Controllers\Lokasi;

use App\Http\Controllers\Controller;
use App\Models\SubDistrictsModel;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class SubDistrictsController extends Controller
{
    public function index($id_district, $id = null)
    {
        if ($id === null) {
            $subdistricts = SubDistrictsModel::where('dis_id', $id_district)->get();
        } else {
            $subdistricts = SubDistrictsModel::where('dis_id', $id_district)->find($id);
        }
        $response = [
            'status' => true,
            'message' => 'Data Desa',
            'data' => $subdistricts,
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }
}
