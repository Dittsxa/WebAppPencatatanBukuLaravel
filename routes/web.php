<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;

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

Route::get('/', [BukuController::class, 'index']);

Route::resource('buku', BukuController::class);

// Method Tambah
Route::get('tambah', [BukuController::class, 'tambah']);
Route::post('tambahdata', [BukuController::class, 'store']);

// Method Edit
Route::get('edit/{id}', [BukuController::class, 'edit']);
Route::post('edit/{id}', [BukuController::class, 'update']);

Route::get('search', [BukuController::class, 'search'])->name('search');

Route::get('delete/{id}', [BukuController::class, 'destroy']);

Route::get('detail/{id}', [BukuController::class, 'showData']);