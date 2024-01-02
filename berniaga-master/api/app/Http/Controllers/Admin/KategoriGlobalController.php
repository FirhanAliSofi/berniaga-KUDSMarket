<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriGlobalModel;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class KategoriGlobalController extends Controller
{
    public function index($id = null)
    {
        if ($id === null) {
            $kategori_global = KategoriGlobalModel::get();
        } else {
            $kategori_global = KategoriGlobalModel::find($id);
        }
        $response = [
            'status' => true,
            'message' => 'Data Kategori Global',
            'data' => $kategori_global,
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }

    public function store(Request $request)
    {
        //
        $request->validate([
            'nama_kategori'=>'required',
        ]);
        $data = KategoriGlobalModel::create($request->all());
        $response = [
            'status' => true,
            'message' => 'Sukses Membuat Data Kategori Global',
            'data' => $data
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }

    public function update(Request $request,$id)
    {
//
        $kategori_global=KategoriGlobalModel::find($id);
        $kategori_global->update($request->all());
        $response = [
            'status' => true,
            'message' => 'Sukses Update Data Kategori Global',
            'data' => $kategori_global
    ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }

    public function destroy($id)
{
        KategoriGlobalModel::destroy($id);
        // return JenisUjianModel::all();

        $response = [
            'status' => true,
            'message' => 'Sukses Menghapus Data Kategori Global',
    ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
}
}
