<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PencarianController;   
use App\Http\Controllers\PenjelajahanController;
use App\Http\Controllers\PencarianNamaBantenController;

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

Route::get('/', [DashboardController::class,'index']);

Route::get('/dashboard',[DashboardController::class,'dashboard']);

Route::get('/dashboard/pencarian',[PencarianController::class,'pencarian']);

Route::get('/dashboard/pencarianNamaBanten',[PencarianNamaBantenController::class,'index']);

Route::get('/login',[LoginController::class,'index'])->name('login')->middleware('guest');
Route::post('/login',[LoginController::class,'authenticate']);
Route::post('/logout',[LoginController::class,'logout']);

Route::resource('/dashboard/admin',AdminController::class)->except('show')->middleware('is_admin');

Route::get('/dashboard/penjelajahan',[PenjelajahanController::class,'penjelajahan']);

Route::get('/dashboard/penjelajahan/?NamaYadnya={banten:namaYadnya}',[PenjelajahanController::class,'penjelajahanYadnya']);

Route::get('/dashboard/detail/{namaBanten}',[DetailController::class,'detail']);

