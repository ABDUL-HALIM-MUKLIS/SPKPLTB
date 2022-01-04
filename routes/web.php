<?php

use App\Http\Controllers\C_login;
use App\Http\Controllers\C_sampel;
use App\Http\Controllers\C_kriteria;
use App\Http\Controllers\C_dashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\C_registrasi;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\SubkriteriaController;

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

Route::get('/', [C_dashboard::class, 'index'])->middleware('auth');

Route::get('/login', [C_login::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [C_login::class, 'authenticate']);

// Route::get('/registrasi', [C_registrasi::class, 'index'])->middleware('guest');
// Route::post('/registrasi', [C_registrasi::class, 'store']);

Route::post('/logout', [C_login::class, 'logout']);
Route::get('/logout', [C_login::class, 'logout'])->middleware('auth');

// Admin 
Route::get('/dashboard', [C_dashboard::class, 'index'])->middleware('auth');


// dashboard sampel
Route::get('/sampel',[C_sampel::class, 'index'] )->middleware('auth');
Route::post('/sampel',[C_sampel::class, 'post'] )->middleware('auth');

// dashboard sampel tambah lokasi
Route::post('/lokasi', [LokasiController::class, 'store'])->middleware('auth');
Route::resource('/lokasi', LokasiController::class)->middleware('auth');

Route::post('/kriteria', [KriteriaController::class, 'store'])->middleware('auth');
Route::get('/kriteria/edit/{id}', [KriteriaController::class, 'edit'])->middleware('auth');


// Route::get('/kriteria/checkSlug', [KriteriaController::class, 'checkSlug'])->middleware('auth');

Route::resource('/kriteria', KriteriaController::class)->middleware('auth');




Route::post('/subkriteria', [SubkriteriaController::class, 'store'])->middleware('auth');

// Route::get('/subkriteria', SubkriteriaController::class, 'index')->middleware('auth');
// Route::resource('/subkriteria', SubkriteriaController::class)->middleware('auth');

Route::get('/spk',[KriteriaController::class, 'index'] )->middleware('auth');

Route::post('/sensor', [SensorController::class, 'store']);
Route::get('/sensor', [SensorController::class, 'store']);
Route::get('/sensor/wa', [SensorController::class, 'wa']);