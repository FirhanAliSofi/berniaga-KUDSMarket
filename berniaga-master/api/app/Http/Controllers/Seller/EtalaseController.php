<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EtalaseModel;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;


class EtalaseController extends Controller
{
    public function index_etalase($id = null)
    {
        if ($id === null) {
            $etalase = EtalaseModel::get();
        } else {
            $etalase = EtalaseModel::find($id);
        }
        $response = [
            'status' => true,
            'message' => 'Data Etalase',
            'data' => $etalase,
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }

    public function store_etalase(Request $request)
    {
        //
        $request->validate([
            'nama_etalase'=>'required',
        ]);
        $data = EtalaseModel::create($request->all());
        $response = [
            'status' => true,
            'message' => 'Sukses Membuat Data Etalase',
            'data' => $data
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }

    public function update_etalase(Request $request,$id)
    {
        //
        $etalase=EtalaseModel::find($id);
        $etalase->update($request->all());
        $response = [
            'status' => true,
            'message' => 'Sukses Update Data Etalase',
            'data' => $etalase
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }

    public function destroy_etalase($id)
    {
        EtalaseModel::destroy($id);
        // return JenisUjianModel::all();
        
        $response = [
            'status' => true,
            'message' => 'Sukses Menghapus Data Etalase',
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
}
}
