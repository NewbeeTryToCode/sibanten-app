<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\PencarianController;
use App\Http\Controllers\PenjelajahanController;

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
    return view('index');
});

Route::get('/dashboard',[DashboardController::class,'index']);
Route::get('/dashboard/pencarian',[PencarianController::class,'pencarian']);
Route::get('/dashboard/pencarian/fetch_data',[PencarianController::class,'fetch_data']);
Route::get('/dashboard/penjelajahan',[PenjelajahanController::class,'index']);
Route::get('/dashboard/bantens',[DetailController::class,'index']);

