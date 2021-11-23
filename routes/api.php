<?php

use App\Http\Controllers\ArsipController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'Arsip'], function(){
    Route::get('get-data', [ArsipController::class, 'getDataIndex'])->name('arsip.getData');
    Route::post('store', [ArsipController::class, 'store'])->name('arsip.store');
    Route::get('detail/{id}', [ArsipController::class, 'detail'])->name('arsip.detail');
    Route::delete('delete/{id}', [ArsipController::class, 'destroy'])->name('arsip.delete');
    // Search Data
    Route::get('search-data/{judul}', [ArsipController::class, 'search'])->name('arsip.search');
    // Unduh Data
    Route::get('download-arsip/{file}', [ArsipController::class, 'download'])->name('arsip.download');
});
