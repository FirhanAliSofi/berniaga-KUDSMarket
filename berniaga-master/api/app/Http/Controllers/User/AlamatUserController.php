<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\AlamatUserModel;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class AlamatUserController extends Controller
{
    public function index($id = null)
    {
        if ($id == null) {
            $alamat_user = AlamatUserModel::get();
        } else {
            $alamat_user = AlamatUserModel::find($id);
        }
        $response = [
            'status' => true,
            'message' => 'Data Alamat User',
            'data' => $alamat_user,
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }

    public function store(Request $request)
    {
        //
        $request->validate([
            'provinsi','kota','kodepos','alamat_lengkap','id_user'=>'required',
        ]);
        $data = AlamatUserModel::create($request->all());
        $response = [
            'status' => true,
            'message' => 'Sukses Membuat Data Alamat User',
            'data' => $data
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }

    public function update(Request $request,$id)
    {
//
        $alamat_user=AlamatUserModel::find($id);
        $alamat_user->update($request->all());
        $response = [
            'status' => true,
            'message' => 'Sukses Update Data Alamat User',
            'data' => $alamat_user
    ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }

    public function destroy($id)
{
        AlamatUserModel::destroy($id);
        // return JenisUjianModel::all();

        $response = [
            'status' => true,
            'message' => 'Sukses Menghapus Data Alamat User',
    ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
}
}
