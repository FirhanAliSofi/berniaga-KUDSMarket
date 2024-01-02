<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SellerModel;
use App\Models\TokoModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
use Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:seller,email',
            'password' => 'required|string|min:8',
            'jenis_kelamin' => 'required|string',
            'no_telp' => 'required|',
            'tanggal_lahir' => 'required|date|min:8',
            'profesi' => 'required|string',
            'nik' => 'required|string|unique:seller,nik',
            'id_province' => 'required',
            'id_cities' => 'required',
            'id_district' => 'required',
            'id_subdistrict'=>'required',
            'alamat_lengkap' => 'required|',
            'kodepos' => 'required|string',
            'status_verifikasi' => 'required',
        ]);

        if($validator->fails())
        {
            return response() -> json($validator->errors());
        }

        if ($request->hasFile('foto_ktp')) {
            $foto_ktp = $request->file('foto_ktp');
            $randomNumber = rand();
            $foto_ktp_name = $randomNumber. '-' . $foto_ktp->hashName();
            $foto_ktp->storeAs('public/foto_ktp/', $foto_ktp_name);
        }

        if ($request->hasFile('foto_wajah')) {
            $foto_wajah = $request->file('foto_wajah');
            $randomNumber = rand();
            $foto_wajah_name = $randomNumber. '-' . $foto_wajah->hashName();            
            $foto_wajah->storeAs('public/foto_wajah/', $foto_wajah_name);
        }

        $seller = SellerModel::create([
            'nama' => $request ->nama,
            'email' => $request ->email,
            'password' => Hash::make($request ->password),
            'jenis_kelamin' => $request ->jenis_kelamin,
            'no_telp' => $request ->no_telp,
            'tanggal_lahir' => $request ->tanggal_lahir,
            'profesi' => $request ->profesi,
            'nik' => $request ->nik,
            'foto_ktp' => $foto_ktp_name,
            'foto_wajah' => $foto_wajah_name,
            'id_province' => $request ->id_province,
            'id_cities' => $request ->id_cities,
            'id_district' => $request ->id_district,
            'id_subdistrict' => $request ->id_subdistrict,
            'alamat_lengkap' => $request ->alamat_lengkap,
            'kodepos' => $request ->kodepos,
            'status_verifikasi' => $request ->status_verifikasi,
        ]);

        $seller->nik = null;
        $seller->foto_ktp = null;
        $seller->foto_wajah = null;
        $seller->no_telp = null;
        $seller->alamat_lengkap = null;

        $response = [
            'status' => true,
            'message' => 'Register Seller telah berhasil',
            'data' => $seller,
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        if($validator->fails())
        {
            if ($validator->errors()->has('password')) {
                return response()->json([
                    'status' => false,
                    'message' => 'Password minimal harus 8 karakter!',
                ], 400);
            } else {
                return response()->json($validator->errors(), 400);
            }
        }

        $seller = SellerModel::where('email', $request['email'])->first();
        $seller->nik = null;
        $seller->foto_ktp = null;
        $seller->foto_wajah = null;
        $seller->no_telp = null;
        $seller->alamat_lengkap = null;
        $id_seller = $seller->id;
        if ($seller) {
            $toko = TokoModel::where('id_seller', $id_seller)->with('seller')->first();
            if (Hash::check($request->password, $seller->password)) {
                $token = $seller->createToken('auth_token_seller')->plainTextToken;
        
                return response()->json([
                    'status' => true,
                    'message' => 'Hi '.$seller->nama.', welcome to home',
                    'toko' => $toko,
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'seller' => $seller,
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Email atau Password Salah!',
                ], 400);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Email atau Password Salah!',
            ], 400);
        }

    }
    
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];
    }
}
