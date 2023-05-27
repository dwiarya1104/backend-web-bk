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

// AUTH
Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('register', [App\Http\Controllers\AuthController::class, 'register']);
Route::middleware('auth:sanctum')->post('logout', [App\Http\Controllers\AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->get('get-user', [App\Http\Controllers\AuthController::class, 'get_user']);

// ABSEN
Route::post('absen/tambah-absensi', [App\Http\Controllers\AbsensiController::class, 'tambah_absensi']);
Route::get('absen/hari', [App\Http\Controllers\AbsensiController::class, 'total_absen_sehari']);
Route::get('absen/bulan/{month}/{tahun_awal}-{tahun_akhir}/{kelas}-{jurusan}', [App\Http\Controllers\AbsensiController::class, 'absen_perbulan']);
Route::get('absen/semester/{semester}/{tahun_awal}-{tahun_akhir}/{kelas}-{jurusan}', [App\Http\Controllers\AbsensiController::class, 'absen_persemester']);
Route::get('absen/tahun/{year}/{kelas}-{jurusan}', [App\Http\Controllers\AbsensiController::class, 'absen_pertahun']);

// KELAS
Route::get('kelas/list', [App\Http\Controllers\KelasController::class, 'kelas']);
Route::post('kelas/tambah-kelas', [App\Http\Controllers\KelasController::class, 'tambah_kelas']);
Route::put('kelas/{id}/edit-kelas', [App\Http\Controllers\KelasController::class, 'edit_kelas']);
Route::delete('kelas/{id}/hapus-kelas', [App\Http\Controllers\KelasController::class, 'hapus_kelas']);

// PELANGGARAN
Route::get('pelanggaran/list', [App\Http\Controllers\PelanggaranController::class, 'list_pelanggaran']);
Route::get('pelanggaran/top-pelanggar', [App\Http\Controllers\PelanggaranController::class, 'top_pelanggar']);
Route::post('pelanggaran/tambah-pelanggar', [App\Http\Controllers\PelanggaranController::class, 'tambah_pelanggar']);
Route::put('pelanggaran/{id}/edit-pelanggar', [App\Http\Controllers\PelanggaranController::class, 'edit_pelanggaran']);
Route::delete('pelanggaran/{id}/hapus-pelanggar', [App\Http\Controllers\PelanggaranController::class, 'hapus_pelanggaran']);

// PENGHARGAAN
Route::get('penghargaan/list', [App\Http\Controllers\PenghargaanController::class, 'list_penghargaan']);
Route::get('penghargaan/top-prestasi', [App\Http\Controllers\PenghargaanController::class, 'top_penghargaan']);
Route::post('penghargaan/tambah-prestasi', [App\Http\Controllers\PenghargaanController::class, 'tambah_penghargaan']);
// Route::put('penghargaan/{id}/edit-prestasi', [App\Http\Controllers\PenghargaanController::class, 'edit_penghargaan']);
Route::delete('penghargaan/{id}/hapus-prestasi', [App\Http\Controllers\PenghargaanController::class, 'hapus_penghargaan']);

// POINT
Route::get('point/siswa/{nis}', [App\Http\Controllers\PelanggaranController::class, 'point_persiswa']);
Route::get('point/{kelas}-{jurusan}', [App\Http\Controllers\PelanggaranController::class, 'point_perkelas']);

// SISWA
Route::post('siswa/import', [App\Http\Controllers\SiswaController::class, 'import']);
Route::get('siswa/list', [App\Http\Controllers\SiswaController::class, 'data_siswa']);
Route::get('siswa/{kelas}-{jurusan}', [App\Http\Controllers\SiswaController::class, 'data_siswa_perkelas']);
Route::post('siswa/tambah-siswa', [App\Http\Controllers\SiswaController::class, 'tambah_siswa']);
Route::put('siswa/{id}/edit-siswa', [App\Http\Controllers\SiswaController::class, 'edit_siswa']);
Route::delete('siswa/{id}/hapus-siswa', [App\Http\Controllers\SiswaController::class, 'hapus_siswa']);
Route::post('siswa/hapus-siswa', [App\Http\Controllers\SiswaController::class, 'hapus_selected_siswa']);
