<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\SellerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;


class SellerController extends Controller
{
    // Index Seller
    public function index($id = null)
    {
        if ($id == null) {
            $seller = SellerModel::get();
            $seller = $seller->map(function ($item) {
                return [
                    "id" => $item->id,
                    "nama" => $item->nama,
                    "email" => $item->email,
                    "password" => $item->password,
                    "jenis_kelamin" => $item->jenis_kelamin,
                    "no_telp" => $item->no_telp,
                    "tanggal_lahir" => $item->tanggal_lahir,
                    "nik" => $item->nik,
                    "foto_ktp" => $item->foto_ktp ? (url(Storage::url('foto_ktp/' . $item->foto_ktp))) : null,
                    "foto_wajah" => $item->foto_wajah ? (url(Storage::url('foto_wajah/' . $item->foto_wajah))) : null,
                    "alamat_lengkap" => $item->alamat_lengkap,
                    "kodepos" => $item->kodepos,
                    "profesi" => $item->profesi,
                    "status_verifikasi" => $item->status_verifikasi,
                    "id_province" => $item->id_province,
                    "id_cities" => $item->id_cities,
                    "id_district" => $item->id_district,
                    "id_subdistrict" => $item->id_subdistrict,
                    "created_at" => $item->created_at,
                    "updated_at" => $item->updated_at,
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
            'message' => 'Sukses Get Data Seller',
            'data' => $seller,
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }
}
