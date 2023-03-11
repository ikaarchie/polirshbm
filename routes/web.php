<?php

use Illuminate\Support\Facades\Route;
use App\Events\ServerCreated;
use App\Http\Controllers\AntrianPoliController;

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

Route::group(['prefix' => 'ekse'], function() {
    Route::get('input', [AntrianPoliController::class, 'showEkse'])->name('showEkse');
    Route::post('save', [AntrianPoliController::class, 'saveEkse'])->name('saveEkse');
    Route::get('panggil', [AntrianPoliController::class, 'panggilEkse'])->name('panggilEkse');
    Route::get('savepanggilEkse/{id}', [AntrianPoliController::class, 'savepanggilEkse'])->name('savepanggilEkse');
    Route::get('savependingEkse/{id}', [AntrianPoliController::class, 'savependingEkse'])->name('savependingEkse');
    Route::get('saveselesaiEkse/{id}', [AntrianPoliController::class, 'saveselesaiEkse'])->name('saveselesaiEkse');
    Route::get('display', [AntrianPoliController::class, 'displayEkse'])->name('displayEkse');
});


Route::group(['prefix' => 'reg'], function() {
    Route::get('input', [AntrianPoliController::class, 'showReg'])->name('showReg');
    Route::post('save', [AntrianPoliController::class, 'saveReg'])->name('saveReg');
    Route::get('panggil', [AntrianPoliController::class, 'panggilReg'])->name('panggilReg');
    Route::get('savepanggilReg/{id}', [AntrianPoliController::class, 'savepanggilReg'])->name('savepanggilReg');
    Route::get('savependingReg/{id}', [AntrianPoliController::class, 'savependingReg'])->name('savependingReg');
    Route::get('saveselesaiReg/{id}', [AntrianPoliController::class, 'saveselesaiReg'])->name('saveselesaiReg');
    Route::get('display', [AntrianPoliController::class, 'displayReg'])->name('displayReg');
});

Route::get('/test-broadcast-event', function () {
    ServerCreated::dispatch('Burhan ganteng');

    echo 'test broadcast event sangcahaya.id';
});
