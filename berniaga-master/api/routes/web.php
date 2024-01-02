<?php

use App\Http\Controllers\Admin\SellerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/seller', [SellerController::class, 'export_pdf']);

Route::get('/export-seller', [SellerController::class, 'exportPDF']);

Route::get('/export-pdf/{id}', [SellerController::class, 'export']);
Route::get('/data-seller-excel', [App\Http\Controllers\admin\SellerController::class, 'dataSellerExcel']);


