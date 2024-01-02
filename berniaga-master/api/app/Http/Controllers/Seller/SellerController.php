<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\SellerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class SellerController extends Controller
{
    // Index Produk
    public function index($id = null)
    {
        if ($id == null) {
            $seller = SellerModel::get();
            $seller = $seller->map(function ($item) {
                return [
                    "id" => $item->id,
                    "nama" => $item->nama,
                    "email" => $item->email,
                    "jenis_kelamin" => $item->jenis_kelamin,
                    "tanggal_lahir" => $item->tanggal_lahir,
                    "no_telp" => $item->no_telp,
                    "foto_ktp" => $item->foto_ktp ? (url(Storage::url('foto_ktp/' . $item->foto_ktp))) : null,
                    "foto_wajah" => $item->foto_wajah ? (url(Storage::url('foto_wajah/' . $item->foto_wajah))) : null,
                    "profesi" => $item->profesi,
                    "id_province" => $item->id_province,
                    "id_cities" => $item->id_cities,
                    "id_district" => $item->id_district,
                    "id_subdistrict" => $item->id_subdistrict,
                    "alamat_lengkap" => $item->alamat_lengkap,
                    "kodepos" => $item->kodepos,
                    "created_at" => $item->created_at,
                    "updated_at" => $item->update_at,
                ];
            });
        } else {
            $seller = collect(SellerModel::where('id', $id)->first())->map(function ($item, $key) {
                if ($key === 'foto_ktp') {
                    return $item ? url(Storage::url('foto_ktp/' . $item)) : null;
                }
                if ($key === 'foto_wajah') {
                    return $item ? url(Storage::url('foto_wajah/' . $item)) : null;
                }
                return $item;
            });
        }

        $response = [
            'status' => true,
            'message' => 'Data Seller',
            'data' => $seller,
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }

    public function update(Request $request,$id)
    {
        //
        $seller=SellerModel::find($id);
        $seller->update($request->all());
        $response = [
            'status' => true,
            'message' => 'Success update data seller',
            'data' => $seller
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }

    public function destroy($id)
    {
        SellerModel::destroy($id);
        // return MapelModel::all();
        
        $response = [
            'status' => true,
            'message' => 'Success delete data',
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }
}
