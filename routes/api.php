<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PengaduanController;
use App\Http\Controllers\api\StatusPengaduanController;

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

Route::post('login', [\App\Http\Controllers\Api\AuthController::class, 'login']);

Route::post('/pengaduan', [PengaduanController::class, 'store']);
Route::get('/kategori', [PengaduanController::class, 'getKategoriPengaduan']);
Route::get('/statusPengaduan', [StatusPengaduanController::class, 'index']);
Route::get('/getPengaduan', [StatusPengaduanController::class, 'get_pengaduan']);

Route::post('logout', [\App\Http\Controllers\Api\AuthController::class, 'logout'])->middleware('auth:sanctum');

