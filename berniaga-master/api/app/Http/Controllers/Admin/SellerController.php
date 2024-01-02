<?php

namespace App\Http\Controllers\Admin;

use App\Models\SellerModel;
use App\Models\TokoModel;
use Illuminate\Http\Request;
use App\Exports\SellerExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\PDF as PDF;
use Barryvdh\DomPDF\PDF as DomPDF;

class SellerController extends Controller
{
    // Index Seller
    public function index($id = null)
    {
        if ($id == null) {
            $seller = SellerModel::where('status_verifikasi', "1")->with('provinces', 'cities', 'district', 'subdistrict')->get();
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
                    "provinces" => $item->provinces->prov_name,
                    "cities" => $item->cities,
                    "district" => $item->district,
                    "subdistrict" => $item->subdistrict,
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

    public function index_belum_verifikasi($id = null)
    {
        if ($id == null) {
            $seller = SellerModel::where('status_verifikasi', "0")->with('provinces', 'cities', 'district', 'subdistrict')->get();
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
                    "provinces" => $item->provinces->prov_name,
                    "cities" => $item->cities,
                    "district" => $item->district,
                    "subdistrict" => $item->subdistrict,
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

    public function verifikasi(Request $request, $id)
    {
        //
        $verifikasi = SellerModel::find($id);
        $verifikasi->update($request->all());
        $response = [
            'status' => true,
            'message' => 'Sukses Memverifikasi',
            'data' => $verifikasi
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }

    public function export($id)
    {
        $seller = SellerModel::where('id', $id)->with('provinces', 'cities', 'district', 'subdistrict')->get();
        $seller = $seller->map(function ($item) {
            return [
                "id" => $item->id,
                "nama" => $item->nama,
                "email" => $item->email,
                "jenis_kelamin" => $item->jenis_kelamin,
                "no_telp" => $item->no_telp,
                "tanggal_lahir" => $item->tanggal_lahir,
                "nik" => $item->nik,
                "foto_ktp" => $item->foto_ktp,
                "foto_wajah" => $item->foto_wajah,
                "alamat_lengkap" => $item->alamat_lengkap,
                "kodepos" => $item->kodepos,
                "profesi" => $item->profesi,
                "status_verifikasi" => $item->status_verifikasi,
                "provinces" => $item->provinces->prov_name,
                "cities" => $item->cities->city_name,
                "district" => $item->district->dis_name,
                "subdistrict" => $item->subdistrict->subdis_name,
                "created_at" => $item->created_at,
                "updated_at" => $item->updated_at,
            ];
        });
        $toko = TokoModel::where('id_seller', $id)->with('provinces', 'cities', 'district', 'subdistrict')->get();
        $response = [
            'data' => $seller,
            'toko' => $toko,
        ];
        $pdf = PDF::loadView('pdf.export', $response);

        return $pdf->stream('data-seller.pdf');
    }

    public function updateStatusVerifikasi($id)
    {
        $data = SellerModel::find($id);
        if ($data) {
            $data->status_verifikasi = '1';
            $data->save();
            $response = [
                'status' => true,
                'message' => 'Sukses Verifikasi Seller!',
                'data' => $data,
            ];
            return response()->json($response, HttpFoundationResponse::HTTP_OK);
        }
        return response()->json(['message' => 'Data tidak ditemukan'], 404);
    }

    public function destroy($id)
    {
        SellerModel::destroy($id);
        $toko = TokoModel::where('id_seller', $id);
        if($toko)
        {
            $toko->delete();
        }
        
        $response = [
            'status' => true,
            'message' => 'Success delete data',
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }

    public function dataSellerExcel()
    {
        $data = [
            'status' =>true,
        ];
        return Excel::download(new SellerExport, 'data-seller.xlsx');

        return response()->json($response, HttpFoundationResponse::HTTP_OK)->download($filePath)->deleteFileAfterSend();
    }

}
