<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ProdukModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class ProdukController extends Controller
{

    public function index($id = null)
    {
        if ($id == null) {
            $produk = ProdukModel::get();
            $produk = $produk->map(function ($item) {
                return [
                    "id" => $item->id,
                    "nama_produk" => $item->nama_produk,
                    "merek" => $item->merek,
                    "kondisi" => $item->kondisi,
                    "deskripsi_produk" => $item->deskripsi_produk,
                    "link_produk" => $item->link_produk,
                    "foto_produk1" => $item->foto_produk1 ? (url(Storage::url('foto_produk/' . $item->foto_produk1))) : null,
                    "foto_produk2" => $item->foto_produk2 ? (url(Storage::url('foto_produk/' . $item->foto_produk2))) : null,
                    "foto_produk3" => $item->foto_produk3 ? (url(Storage::url('foto_produk/' . $item->foto_produk3))) : null,
                    "status_varian" => $item->status_varian,
                    "id_toko" => $item->id_toko,
                    "id_etalase" => $item->id_etalase,
                    "id_kategori" => $item->id_kategori,
                    "created_at" => $item->created_at,
                    "updated_at" => $item->updated_at,
                ];
            });
        } else {
            $produk = collect(ProdukModel::where('id', $id)->first())->map(function ($item, $key) {
                if ($key === 'foto_produk1') {
                    return $item ? url(Storage::url('foto_produk/' . $item)) : null;
                }
                if ($key === 'foto_produk2') {
                    return $item ? url(Storage::url('foto_produk/' . $item)) : null;
                }
                if ($key === 'foto_produk3') {
                    return $item ? url(Storage::url('foto_produk/' . $item)) : null;
                }
                return $item;
            });
        }

        $response = [
            'status' => true,
            'message' => 'Data Produk',
            'data' => $produk,
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }
}

?>