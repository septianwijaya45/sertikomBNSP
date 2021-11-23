<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ArsipController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [ArsipController::class, 'index'])->name('arsip.index');
Route::get('/insert-data', [ArsipController::class, 'insert'])->name('arsip.insert');
Route::get('detail/{id}', [ArsipController::class, 'detail'])->name('arsip.detail');
Route::get('edit/{id}', [ArsipController::class, 'edit'])->name('arsip.edit');
Route::get('about', [AboutController::class, 'index'])->name('about');
