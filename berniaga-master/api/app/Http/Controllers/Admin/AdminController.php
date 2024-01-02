<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminModel;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;


class AdminController extends Controller
{
    public function index($id = null)
    {
        if ($id === null) {
            $admin = AdminModel::get();
        } else {
            $admin = AdminModel::find($id);
        }
        $response = [
            'status' => true,
            'message' => 'Success get data admin',
            'data' => $admin,
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }
    public function update(Request $request,$id)
    {
        //
        $admin=AdminModel::find($id);
        $admin->update($request->all());
        $response = [
            'status' => true,
            'message' => 'Success update data admin',
            'data' => $admin
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }
    public function destroy($id)
    {
        AdminModel::destroy($id);
        // return AdminModel::all();
        
        $response = [
            'status' => true,
            'message' => 'Success delete data admin',
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }
}