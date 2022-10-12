<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// LIST PENGHARGAAN DAN PELANGGARAN
Route::get('list-pelanggaran', [App\Http\Controllers\PelanggaranController::class, 'list_pelanggaran']);
Route::get('list-penghargaan', [App\Http\Controllers\PenghargaanController::class, 'list_penghargaan']);

Route::get('top-pelanggar', [App\Http\Controllers\PelanggaranController::class, 'top_pelanggar']);
Route::get('top-prestasi', [App\Http\Controllers\PenghargaanController::class, 'top_penghargaan']);

Route::post('tambah-pelanggar', [App\Http\Controllers\PelanggaranController::class, 'tambah_pelanggar']);
Route::post('tambah-prestasi', [App\Http\Controllers\PenghargaanController::class, 'tambah_penghargaan']);

Route::post('absensi', [App\Http\Controllers\AbsensiController::class, 'absensi']);
