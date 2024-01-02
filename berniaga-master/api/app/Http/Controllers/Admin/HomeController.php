<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProdukModel;
use Illuminate\Http\Request;
use App\Models\SellerModel;
use App\Models\UserModel;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class HomeController extends Controller
{
    public function getSellerCount()
    {
        $count = SellerModel::count();
        $response = [
            'status' => true,
            'count' => $count,
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);    
    }
    public function getUserCount()
    {
        $count = UserModel::count();
        $response = [
            'status' => true,
            'count' => $count,
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);    
    }
    public function getProdukCount()
    {
        $count = ProdukModel::count();
        $response = [
            'status' => true,
            'count' => $count,
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);    
    }
}
