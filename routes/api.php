<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PelangganDataController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PenyewaanController;
use App\Http\Controllers\PenyewaanDetailController;
use App\Http\Controllers\KategoriController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('alat', AlatController::class);
Route::apiResource('pelanggan', PelangganController::class);
Route::apiResource('pelanggan-data', PelangganDataController::class);
Route::apiResource('penyewaan', PenyewaanController::class);
Route::apiResource('penyewaan-detail', PenyewaanDetailController::class);
Route::apiResource('kategori', KategoriController::class);
Route::apiResource('admin', AdminController::class)->middleware('jwt.validate');
Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
});
