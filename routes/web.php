<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\JeniscuciController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [UserController::class, 'index']);
Route::post('/user-add', [UserController::class, 'store']);
Route::post('/cek-add', [UserController::class, 'create']);
Route::get('/profil', [UserController::class, 'show']);
Route::put('/edit-profil', [UserController::class, 'update']);
Route::put('/edit-pass', [UserController::class, 'edit']);
Route::put('/edit-foto', [UserController::class, 'profil']);


Route::get('/register', [AuthController::class, 'register'])->middleware('guest');
Route::post('/signin', [AuthController::class, 'signin'])->middleware('guest');
Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate']);

Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/dashboard', [AdminController::class, 'index'])->middleware('auth');

Route::group(['prefix' => 'pesanan', 'middleware' => ['auth', 'must-admin']], function () {
    Route::get('/', [PesananController::class, 'index']);
    Route::get('/view/{id}', [PesananController::class, 'show'])->name('pesanan.show');
    Route::get('/add', [PesananController::class, 'create']);
    Route::post('/store', [PesananController::class, 'store']);
    Route::get('/{id}', [PesananController::class, 'edit']);
    Route::put('/edit/{id}', [PesananController::class, 'update']);
    Route::get('/delete/{id}', [PesananController::class, 'destroy']);
});

    // Route::get('/pesanan', [PesananController::class, 'index'])->middleware('auth');
    // Route::get('/pesanan-add', [PesananController::class, 'create'])->middleware('auth');
    // Route::post('/add-pesanan', [PesananController::class, 'store'])->middleware('auth');
    // Route::get('/pesanan-sub', [PesananController::class, 'subtotal'])->middleware('auth');
    // Route::get('/pesanan-edit/{id}', [PesananController::class, 'edit'])->middleware('auth');
    // Route::put('/pesanan/{id}', [PesananController::class, 'update'])->middleware('auth');
    // Route::get('/pesanan-destroy/{id}', [PesananController::class, 'destroy'])->middleware('auth');

Route::get('/kategori', [KategoriController::class, 'index'])->middleware('auth');
Route::get('/kategori-add', [KategoriController::class, 'create'])->middleware('auth');
Route::post('/add-kategori', [KategoriController::class, 'store'])->middleware('auth');
Route::get('/kategori-edit/{id}', [KategoriController::class, 'edit'])->middleware('auth');
Route::put('/kategori/{id}', [KategoriController::class, 'update'])->middleware('auth');
Route::get('/kategori-destroy/{id}', [KategoriController::class, 'destroy'])->middleware('auth');

Route::get('/jeniscuci', [JeniscuciController::class, 'index'])->middleware('auth');
Route::get('/jeniscuci-add', [JeniscuciController::class, 'create'])->middleware('auth');
Route::post('/add-jeniscuci', [JeniscuciController::class, 'store'])->middleware('auth');
Route::get('/jeniscuci-edit/{id}', [JeniscuciController::class, 'edit'])->middleware('auth');
Route::put('/jeniscuci/{id}', [JeniscuciController::class, 'update'])->middleware('auth');
Route::get('/jeniscuci-destroy/{id}', [JeniscuciController::class, 'destroy'])->middleware('auth');

Route::get('/customer', [CustomerController::class, 'index'])->middleware('auth');
Route::get('/customer-edit/{id}', [CustomerController::class, 'edit'])->middleware('auth');
Route::get('/customer-destroy/{id}', [CustomerController::class, 'destroy'])->middleware('auth');


