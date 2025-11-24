<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\KomponenController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\DetailPembelianController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['prefix'=>'admin','midleware'=>['auth']], function () {
    Route::resource('menu', User::class);
});

Route::resource('kategori', KategoriController::class);

Route::resource('kategori', KategoriController::class);
Route::resource('supplier', SupplierController::class);
Route::resource('komponen', KomponenController::class);
Route::resource('pembelian', PembelianController::class);
Route::resource('detail_pembelian', DetailPembelianController::class);
