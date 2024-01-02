<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class UserController extends Controller
{
    public function index($id = null)
    {
        if ($id === null) {
            $user = UserModel::get();
        } else {
            $user = UserModel::find($id);
        }
        $response = [
            'status' => true,
            'message' => 'Success get data user',
            'data' => $user,
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        //
        $user = UserModel::find($id);
        $user->update($request->all());
        $response = [
            'status' => true,
            'message' => 'Success update data user',
            'data' => $user
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }

    public function destroy($id)
    {
        UserModel::destroy($id);
        // return MapelModel::all();

        $response = [
            'status' => true,
            'message' => 'Success delete data user',
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }
}
