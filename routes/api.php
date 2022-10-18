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

Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('logout', [App\Http\Controllers\AuthController::class, 'logout']);
// LIST PENGHARGAAN DAN PELANGGARAN
Route::get('list-pelanggaran', [App\Http\Controllers\PelanggaranController::class, 'list_pelanggaran']);
Route::get('list-penghargaan', [App\Http\Controllers\PenghargaanController::class, 'list_penghargaan']);

Route::get('top-pelanggar', [App\Http\Controllers\PelanggaranController::class, 'top_pelanggar']);
Route::get('top-prestasi', [App\Http\Controllers\PenghargaanController::class, 'top_penghargaan']);

Route::post('tambah-pelanggar', [App\Http\Controllers\PelanggaranController::class, 'tambah_pelanggar']);
Route::post('tambah-prestasi', [App\Http\Controllers\PenghargaanController::class, 'tambah_penghargaan']);

Route::post('tambah-absensi', [App\Http\Controllers\AbsensiController::class, 'absensi']);

Route::post('tambah-kelas', [App\Http\Controllers\KelasController::class, 'tambah_kelas']);

Route::get('absen/bulan/{month}/{kelas}-{jurusan}', [App\Http\Controllers\AbsensiController::class, 'absen_perbulan']);
Route::get('absen/tahun/{year}/{kelas}-{jurusan}', [App\Http\Controllers\AbsensiController::class, 'absen_pertahun']);
Route::get('absen/semester/{semester}/{tahun_awal}-{tahun_akhir}/{kelas}-{jurusan}', [App\Http\Controllers\AbsensiController::class, 'absen_persemester']);

Route::get('tes', [App\Http\Controllers\AbsensiController::class, 'tes']);
