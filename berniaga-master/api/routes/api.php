<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellerController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('admin/login-admin', [App\Http\Controllers\Admin\AuthController::class, 'login']);

Route::post('seller/register-seller', [App\Http\Controllers\Seller\AuthController::class, 'register']);
Route::post('seller/login-seller', [App\Http\Controllers\Seller\AuthController::class, 'login']);

Route::post('user/register-user', [App\Http\Controllers\User\AuthController::class, 'register']);
Route::post('user/login-user', [App\Http\Controllers\User\AuthController::class, 'login']);
Route::post('seller/produk-create', [App\Http\Controllers\Seller\ProdukController::class, 'store']);
Route::get('seller/cek-toko/{idSeller}', [App\Http\Controllers\Seller\TokoController::class, 'cek_toko']);

Route::get('seller/lokasi/province', [App\Http\Controllers\Lokasi\ProvinceController::class, 'index']);
Route::get('seller/lokasi/cities/{id_province}', [App\Http\Controllers\Lokasi\CitiesController::class, 'index']);
Route::get('seller/lokasi/districts/{id_city}', [App\Http\Controllers\Lokasi\DistrictsController::class, 'index']);
Route::get('seller/lokasi/subdistricts/{id_district}', [App\Http\Controllers\Lokasi\SubDistrictsController::class, 'index']);
Route::get('admin/export-pdf/{id}', [App\Http\Controllers\admin\SellerController::class, 'export']);

Route::prefix('admin')->middleware(['auth:sanctum', 'auth.admin'])->group(function () {
    Route::get('/profiles', function (Request $request) {
        return auth()->user();
    });
    Route::get('/admin/{id?}', [App\Http\Controllers\admin\AdminController::class, 'index']);
    Route::post('/register-admin', [App\Http\Controllers\Admin\AuthController::class, 'register']);
    Route::put('/admin/update/{id}', [App\Http\Controllers\admin\AdminController::class, 'update']);
    Route::delete('/admin/delete/{id}', [App\Http\Controllers\admin\AdminController::class, 'destroy']);
    Route::post('/logout-admin', [App\Http\Controllers\Admin\AuthController::class, 'logout']);
    
    //route kategori global
    Route::get('/kategori-global/{id?}', [App\Http\Controllers\admin\KategoriGlobalController::class, 'index']);
    Route::put('/kategori-global-update/{id}', [App\Http\Controllers\admin\KategoriGlobalController::class, 'update']);
    Route::Post('/kategori-global-create', [App\Http\Controllers\Admin\KategoriGlobalController::class, 'store']);
    Route::delete('/kategori-global-delete/{id}', [App\Http\Controllers\admin\KategoriGlobalController::class, 'destroy']);
    
    Route::get('/data-seller/{id?}', [App\Http\Controllers\admin\SellerController::class, 'index']); // Data seller
    Route::get('/data-seller-belum-verifikasi/{id?}', [App\Http\Controllers\admin\SellerController::class, 'index_belum_verifikasi']); //Get data seller belum diverifikasi
    Route::delete('/seller/delete/{id}', [App\Http\Controllers\admin\SellerController::class, 'destroy']); //Delete seller
    Route::get('/verifikasi/{id}', [App\Http\Controllers\admin\SellerController::class, 'updateStatusVerifikasi']); //Untuk memverifikasi

    //route tipe varian 

    Route::get('/data-seller/{id?}', [App\Http\Controllers\admin\SellerController::class, 'index']);
    Route::get('/data-seller-belum-verifikasi/{id?}', [App\Http\Controllers\admin\SellerController::class, 'index_belum_verifikasi']);
    Route::get('/verifikasi/{id}', [App\Http\Controllers\admin\SellerController::class, 'updateStatusVerifikasi']);

    Route::get('/data-seller-excel', [App\Http\Controllers\admin\SellerController::class, 'dataSellerExcel']);
    Route::get('/data-seller-excel-2', [App\Http\Controllers\admin\SellerController::class, 'seller-export.xlsx']);

    Route::get('/tipe-varian/{id?}', [App\Http\Controllers\admin\TipeVarianController::class, 'index']);
    Route::put('/tipe-varian-update/{id}', [App\Http\Controllers\admin\TipeVarianController::class, 'update']);
    Route::Post('/tipe-varian-create', [App\Http\Controllers\admin\TipeVarianController::class, 'store']);
    Route::delete('/tipe-varian-delete/{id}', [App\Http\Controllers\admin\TipeVarianController::class, 'destroy']); 

    Route::get('/data-seller-excel', [App\Http\Controllers\Admin\SellerController::class, 'dataSellerExcel']); //Get data excel

    // Admin get data seller
    Route::get('/seller-count', [App\Http\Controllers\admin\HomeController::class, 'getSellerCount']);

    // Admin get data user
    Route::get('/user-count', [App\Http\Controllers\admin\HomeController::class, 'getUserCount']);

    // Admin get data produk
    Route::get('/produk-count', [App\Http\Controllers\admin\HomeController::class, 'getProdukCount']);    
});

Route::prefix('seller')->middleware(['auth:sanctum', 'auth.seller'])->group(function () {
    Route::get('/profiles', function (Request $request) {
        return auth()->user();
    });

    // Route Seller
    Route::get('/seller/{id?}', [App\Http\Controllers\Seller\SellerController::class, 'index']);
    Route::put('/seller/update/{id}', [App\Http\Controllers\Seller\SellerController::class, 'update']);
    Route::post('/logout-seller', [App\Http\Controllers\Seller\AuthController::class, 'logout']);

    // Route Toko
    Route::get('/toko/{id?}', [App\Http\Controllers\Seller\TokoController::class, 'index']);
    Route::post('/toko-create', [App\Http\Controllers\Seller\TokoController::class, 'store']);
    Route::put('/toko/update/{id}', [App\Http\Controllers\Seller\TokoController::class, 'update']);
    Route::delete('/toko/{id}', [App\Http\Controllers\Seller\TokoController::class, 'destroy']);

    // Route Produk
    Route::get('/produk/{id?}', [App\Http\Controllers\Seller\ProdukController::class, 'index']);
    Route::post('/produk-create', [App\Http\Controllers\Seller\ProdukController::class, 'store']);
    Route::put('/produk/update/{id}', [App\Http\Controllers\Seller\ProdukController::class, 'update']);
    Route::delete('/produk/delete/{id}', [App\Http\Controllers\Seller\ProdukController::class, 'destroy']);

    // Route Stok
    Route::get('/stok/{id?}', [App\Http\Controllers\Seller\ProdukController::class, 'index_stok']);
    Route::post('/stok-create', [App\Http\Controllers\Seller\ProdukController::class, 'store_stok']);
    Route::put('/stok/update/{id}', [App\Http\Controllers\Seller\ProdukController::class, 'update_stok']);
    Route::delete('/stok/delete/{id}', [App\Http\Controllers\Seller\ProdukController::class, 'destroy_stok']);

    // Route Varian1
    Route::get('/varian1/{id?}', [App\Http\Controllers\Seller\ProdukController::class, 'index_varian1']);
    Route::post('/varian1-create', [App\Http\Controllers\Seller\ProdukController::class, 'store_varian1']);
    Route::put('/varian1/update/{id}', [App\Http\Controllers\Seller\ProdukController::class, 'update_varian1']);
    Route::delete('/varian1/delete/{id}', [App\Http\Controllers\Seller\ProdukController::class, 'destroy_varian1']);

    // Route Etalase
    Route::get('/etalase/{id?}', [App\Http\Controllers\Seller\EtalaseController::class, 'index_etalase']);
    Route::post('/etalase-create', [App\Http\Controllers\Seller\EtalaseController::class, 'store_etalase']);
    Route::put('/etalase/update/{id}', [App\Http\Controllers\Seller\EtalaseController::class, 'update_etalase']);
    Route::delete('/etalase/delete/{id}', [App\Http\Controllers\Seller\EtalaseController::class, 'destroy_etalase']);

});

Route::prefix('user')->middleware(['auth:sanctum', 'auth.user'])->group(function () {
    Route::get('/profiles', function (Request $request) {
        return auth()->user();
    });

    //Route User
    Route::get('/user/{id?}', [App\Http\Controllers\User\UserController::class, 'index']);
    Route::put('/user/update/{id}', [App\Http\Controllers\User\UserController::class, 'update']);
    Route::delete('/user/delete/{id}', [App\Http\Controllers\User\UserController::class, 'destroy']);
    Route::post('/logout-user', [App\Http\Controllers\User\AuthController::class, 'logout']);

    Route::get('/alamat-user/{id?}', [App\Http\Controllers\User\AlamatUserController::class, 'index']);
    Route::put('/alamat-user-update/{id}', [App\Http\Controllers\User\AlamatUserController::class, 'update']);
    Route::delete('/alamat-user-delete/{id}', [App\Http\Controllers\User\AlamatUserController::class, 'destroy']);
    Route::post('/alamat-user-create', [App\Http\Controllers\User\AlamatUserController::class, 'store']);

    Route::get('/data-produk/{id?}', [App\Http\Controllers\User\ProdukController::class, 'index']);
    Route::get('/data-seller/{id?}', [App\Http\Controllers\User\SellerController::class, 'index']);
});
    