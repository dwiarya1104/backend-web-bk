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
Route::delete('hapus-pelanggaran/{id}', [App\Http\Controllers\PelanggaranController::class, 'hapus_pelanggaran']);
Route::delete('hapus-penghargaan/{id}', [App\Http\Controllers\PenghargaanController::class, 'hapus_penghargaan']);

Route::get('top-pelanggar', [App\Http\Controllers\PelanggaranController::class, 'top_pelanggar']);
Route::get('top-prestasi', [App\Http\Controllers\PenghargaanController::class, 'top_penghargaan']);

Route::post('tambah-pelanggar', [App\Http\Controllers\PelanggaranController::class, 'tambah_pelanggar']);
Route::get('siswa/point/{nis}', [App\Http\Controllers\PelanggaranController::class, 'point_persiswa']);
Route::get('point/{kelas}-{jurusan}', [App\Http\Controllers\PelanggaranController::class, 'point_perkelas']);

Route::post('tambah-prestasi', [App\Http\Controllers\PenghargaanController::class, 'tambah_penghargaan']);

Route::post('tambah-absensi', [App\Http\Controllers\AbsensiController::class, 'tambah_absensi']);

Route::get('kelas', [App\Http\Controllers\KelasController::class, 'kelas']);
Route::post('tambah-kelas', [App\Http\Controllers\KelasController::class, 'tambah_kelas']);
Route::put('kelas/{id}/edit-kelas', [App\Http\Controllers\KelasController::class, 'edit_kelas']);
Route::delete('kelas/{id}/hapus-kelas', [App\Http\Controllers\KelasController::class, 'hapus_kelas']);

Route::get('absen/hari', [App\Http\Controllers\AbsensiController::class, 'total_absen_sehari']);
Route::get('absen/bulan/{month}/{tahun_awal}-{tahun_akhir}/{kelas}-{jurusan}', [App\Http\Controllers\AbsensiController::class, 'absen_perbulan']);
Route::get('absen/tahun/{year}/{kelas}-{jurusan}', [App\Http\Controllers\AbsensiController::class, 'absen_pertahun']);
Route::get('absen/semester/{semester}/{tahun_awal}-{tahun_akhir}/{kelas}-{jurusan}', [App\Http\Controllers\AbsensiController::class, 'absen_persemester']);

Route::post('import', [App\Http\Controllers\SiswaController::class, 'import']);
Route::get('siswa', [App\Http\Controllers\SiswaController::class, 'data_siswa']);
Route::put('edit-siswa', [App\Http\Controllers\SiswaController::class, 'edit_siswa']);
Route::get('siswa/{kelas}-{jurusan}', [App\Http\Controllers\SiswaController::class, 'get_siswa_perkelas']);
Route::get('hapus-siswa/{id}', [App\Http\Controllers\SiswaController::class, 'hapus_siswa']);
