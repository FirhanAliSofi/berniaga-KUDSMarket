<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\ProdukModel;
use App\Models\StokModel;
use App\Models\Varian1Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    // Index Produk
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
                    "panjang" => $item->panjang,
                    "lebar" => $item->lebar,
                    "tinggi" => $item->tinggi,
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

    // Store Produk
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_produk' => 'required',
            'merek' => 'required',
            'kondisi' => 'required',
            'deskripsi_produk' => 'required',
            'link_produk' => 'required',
            'panjang' => 'required',
            'lebar' => 'required',
            'tinggi' => 'required',
            'id_toko' => 'required',
            'id_etalase' => 'required',
            'id_kategori' => 'required',
        ]);


        if ($request->hasFile('foto_produk1')) {
            $foto_produk = $request->file('foto_produk1');
            $foto_produk1_name = $request->id_toko . '-' . $foto_produk->hashName();
            $foto_produk->storeAs('public/foto_produk/', $foto_produk1_name);
        }

        if ($request->hasFile('foto_produk2')) {
            $foto_produk = $request->file('foto_produk2');
            $foto_produk2_name = $request->id_toko . '-' . $foto_produk->hashName();
            $foto_produk->storeAs('public/foto_produk/', $foto_produk2_name);
        }

        if ($request->hasFile('foto_produk3')) {
            $foto_produk = $request->file('foto_produk3');
            $foto_produk3_name = $request->id_toko . '-' . $foto_produk->hashName();
            $foto_produk->storeAs('public/foto_produk/', $foto_produk3_name);
        }

        $produk = ProdukModel::create([
            'nama_produk'  => $request->nama_produk,
            'merek'  => $request->merek,
            'kondisi'  => $request->kondisi,
            'deskripsi_produk'  => $request->deskripsi_produk,
            'link_produk'  => $request->link_produk,
            'foto_produk1' => $foto_produk1_name,
            'foto_produk2' => $foto_produk2_name,
            'foto_produk3' => $foto_produk3_name,
            'status_varian'  => $request->status_varian,
            'panjang'  => $request->panjang,
            'lebar'  => $request->lebar,
            'tinggi'  => $request->tinggi,
            'id_toko'  => $request->id_toko,
            'id_etalase'  => $request->id_etalase,
            'id_kategori'  => $request->id_kategori,
        ]);

      if($produk->status_varian == 1)
        {
            $hasilStok = [];            
            $hasilVarian1 = [];
            foreach($request->stok as $value)
            {
                $nama_varian = $value['nama_varian'];
                $id_tipe_varian = $value['id_tipe_varian'];

                $varian1 = Varian1Model::create([
                    'nama_varian'  => $nama_varian,
                    'id_tipe_varian'  => $id_tipe_varian,
                ]);
                array_push($hasilVarian1, $varian1);

                $stok = $value['stok'];
                $harga = $value['harga'];
                $berat = $value['berat'];
                $status = $value['status'];
                $stok_create = StokModel::create([
                    'id_produk'  => $produk->id,
                    'id_varian1'  => $varian1->id,
                    'stok'  => $stok,
                    'harga'  => $harga,
                    'berat'  => $berat,
                    'status'  => $status,
                ]);
                array_push($hasilStok, $stok_create);
            }
        } else {
            $this->validate($request, [
                'stok' => 'required',
                'harga' => 'required',
                'berat' => 'required',
                'status' => 'required',
            ]);

            $stok = StokModel::create([
                'id_produk'  => $produk->id_produk,
                'stok'  => $request->stok,
                'harga'  => $request->harga,
                'berat'  => $request->berat,
                'status'  => $request->status,
            ]);
        }
        $response = [
            'status' => true,
            'message' => 'Sukses Menyimpan Produk',
            'data_produk' => $produk,
            'hasilVarian1' => $hasilVarian1,
            'hasilStok' => $hasilStok,
        ];

        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }

    // Update Produk
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_produk' => 'required',
            'merek' => 'required',
            'kondisi' => 'required',
            'deskripsi_produk' => 'required',
            'link_produk' => 'required',
            'panjang' => 'required',
            'lebar' => 'required',
            'tinggi' => 'required',
            'id_toko' => 'required',
            'id_etalase' => 'required',
            'id_kategori' => 'required',
        ]);

        if ($request->hasFile('foto_produk1')) {
            $foto_produk = $request->file('foto_produk1');
            $foto_produk1_name = $request->id_toko . '-' . $foto_produk->hashName();
            $foto_produk->storeAs('public/foto_produk/', $foto_produk1_name);
        }

        if ($request->hasFile('foto_produk2')) {
            $foto_produk = $request->file('foto_produk2');
            $foto_produk2_name = $request->id_toko . '-' . $foto_produk->hashName();
            $foto_produk->storeAs('public/foto_produk/', $foto_produk2_name);
        }

        if ($request->hasFile('foto_produk3')) {
            $foto_produk = $request->file('foto_produk3');
            $foto_produk3_name = $request->id_toko . '-' . $foto_produk->hashName();
            $foto_produk->storeAs('public/foto_produk/', $foto_produk3_name);
        }


        $produk = ProdukModel::find($id);
        $produk->update([
            'nama_produk'  => $request->nama_produk,
            'merek'  => $request->merek,
            'kondisi'  => $request->kondisi,
            'deskripsi_produk'  => $request->deskripsi_produk,
            'link_produk'  => $request->link_produk,
            'foto_produk1' => $foto_produk1_name ?? $produk->foto_produk,
            'foto_produk2' => $foto_produk2_name ?? $produk->foto_produk,
            'foto_produk3' => $foto_produk3_name ?? $produk->foto_produk,
            'status_varian'  => $request->status_varian,
            'panjang'  => $request->panjang,
            'lebar'  => $request->lebar,
            'tinggi'  => $request->tinggi,
            'id_toko'  => $request->id_toko,
            'id_etalase'  => $request->id_etalase,
            'id_kategori'  => $request->id_kategori,
        ]);

        $response = [
            'status' => true,
            'message' => 'Sukses Edit Produk',
            'data' => $produk
        ];

        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }

    // Delete Produk
    public function destroy($id)
    {
        ProdukModel::destroy($id);
        $response = [
            'status' => true,
            'message' => 'Sukses Menghapus Data Produk',
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }
}
