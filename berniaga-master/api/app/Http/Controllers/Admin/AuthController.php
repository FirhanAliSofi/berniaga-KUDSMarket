<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminModel;
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
            'email' => 'required|string|email|max:255|unique:admin',
            'password' => 'required|string|min:8',
        ]);

        if($validator->fails())
        {
            return response() -> json($validator->errors());
        }

        $admin = AdminModel::create([
            'nama' => $request -> nama,
            'email' => $request -> email,
            'password' => Hash::make($request ->password),
        ]);

        $response = [
            'status' => true,
            'message' => 'Register admin telah berhasil',
            'data' => $admin,
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

        $admin = AdminModel::where('email', $request['email'])->first();
        if ($admin) {
            if (Hash::check($request->password, $admin->password)) {
                $token = $admin->createToken('auth_token_admin')->plainTextToken;
        
                return response()->json([
                    'status' => true,
                    'message' => 'Hi '.$admin->name.', welcome to home',
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'admin' => $admin
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
