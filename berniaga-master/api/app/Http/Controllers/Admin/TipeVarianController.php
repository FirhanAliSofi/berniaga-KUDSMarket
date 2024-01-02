<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TipeVarianModel;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class TipeVarianController extends Controller
{
    public function index($id = null)
    {
        if ($id === null) {
            $tipe_varian = TipeVarianModel::get();
        } else {
            $tipe_varian = TipeVarianModel::find($id);
        }
        $response = [
            'status' => true,
            'message' => 'Data tipe varian',
            'data' => $tipe_varian,
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }

    public function store(Request $request)
    {
        //
        $request->validate([
            'nama_tipe'=>'required',
        ]);
        $data = TipeVarianModel::create($request->all());
        $response = [
            'status' => true,
            'message' => 'Sukses Membuat Data Tipe Varian',
            'data' => $data
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }

    public function update(Request $request,$id)
    {
//
        $tipe_varian=TipeVarianModel::find($id);
        $tipe_varian->update($request->all());
        $response = [
            'status' => true,
            'message' => 'Sukses Update Data Tipe Varian',
            'data' => $tipe_varian
    ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }

    public function destroy($id)
{
        TipeVarianModel::destroy($id);
        // return JenisUjianModel::all();

        $response = [
            'status' => true,
            'message' => 'Sukses Menghapus Data Tipe Varian',
    ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
}
}
