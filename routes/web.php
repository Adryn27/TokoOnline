<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('beranda');
});

// Backend
Route::get('backend/beranda',[BerandaController::class, 'berandaBackend'])->name('backend.beranda')->middleware('auth');

Route::get('backend/login',[LoginController::class,'loginBackend'])->name('backend.login');
Route::post('backend/login',[LoginController::class,'authenticateBackend'])->name('backend.login');
Route::post('backend/logout',[LoginController::class,'logoutBackend'])->name('backend.logout');

//Route User
Route::resource('backend/user', UserController::class, ['as'=>'backend'])->middleware('auth');
Route::get('backend/laporan/formuser',[UserController::class,'formUser'])->name('backend.laporan.formuser')->middleware('auth');
Route::post('backend/laporan/cetakuser',[UserController::class,'cetakUser'])->name('backend.laporan.cetakuser')->middleware('auth');

//Route Kategori
Route::resource('backend/kategori', KategoriController::class, ['as' => 'backend'])->middleware('auth');

//Route Produk
Route::resource('backend/produk', ProdukController::class, ['as' => 'backend'])->middleware('auth');
Route::get('backend/laporan/formproduk',[ProdukController::class,'formProduk'])->name('backend.laporan.formproduk')->middleware('auth');
Route::post('backend/laporan/cetakproduk',[ProdukController::class,'cetakProduk'])->name('backend.laporan.cetakproduk')->middleware('auth');
//Route untuk menambahkan foto
Route::post('foto-produk/store',[ProdukController::class,'storeFoto'])->name('backend.foto_produk.store')->middleware('auth');
//Route untuk menghapus foto
Route::delete('foto-produk/{id}',[ProdukController::class,'destroyFoto'])->name('backend.foto_produk.destroy')->middleware('auth');

// Frontend 
Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');

Route::get('/produk/detail/{id}', [ProdukController::class, 'detail'])->name('produk.detail');
Route::get('/produk/kategori/{id}', [ProdukController::class, 'produkKategori'])->name('produk.kategori');
Route::get('/produk/all', [ProdukController::class, 'produkAll'])->name('produk.all');