<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProdukController::class, 'index'])->name('produk.index');

Route::middleware('guest')->group(function () {
    Route::get('/login',     [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',    [AuthController::class, 'login']);
    Route::get('/register',  [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('keranjang')->name('keranjang.')->group(function () {
        Route::get('/',                 [KeranjangController::class, 'index'])->name('index');
        Route::post('/tambah/{id}',     [KeranjangController::class, 'tambah'])->name('tambah');
        Route::post('/ubah/{id}/{aksi}',[KeranjangController::class, 'ubah'])->name('ubah');
        Route::post('/hapus/{id}',      [KeranjangController::class, 'hapus'])->name('hapus');
        Route::post('/kosongkan',       [KeranjangController::class, 'kosongkan'])->name('kosongkan');
    });

    Route::get('/checkout',  [CheckoutController::class, 'form'])->name('checkout.form');
    Route::post('/checkout', [CheckoutController::class, 'proses'])->name('checkout.proses');

    Route::get('/pesanan',         [OrderController::class, 'index'])->name('order.index');
    Route::get('/pesanan/{id}',    [OrderController::class, 'show'])->name('order.show');
});

Route::patch('/admin/users/{user}/role', [RoleController::class, 'update'])
    ->middleware(['auth', 'can:manage-roles'])
    ->name('admin.users.role.update');