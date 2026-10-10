<?php

use App\Http\Controllers\KeranjangController;
use Illuminate\Support\Facades\Route;

Route::get('/', [KeranjangController::class, 'index'])->name('barang.index');

Route::prefix('keranjang')->name('keranjang.')->group(function () {
    Route::get('/',            [KeranjangController::class, 'keranjang'])->name('index');
    Route::post('/tambah/{id}',[KeranjangController::class, 'tambah'])->name('tambah');
    Route::post('/ubah/{id}/{aksi}', [KeranjangController::class, 'ubah'])->name('ubah');
    Route::post('/hapus/{id}', [KeranjangController::class, 'hapus'])->name('hapus');
    Route::post('/kosongkan',  [KeranjangController::class, 'kosongkan'])->name('kosongkan');
});