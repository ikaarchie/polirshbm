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

Route::get('/ekse/input', [AntrianPoliController::class, 'showEkse'])->name('showEkse');
Route::post('/ekse/save', [AntrianPoliController::class, 'saveEkse'])->name('saveEkse');
Route::get('/ekse/panggil', [AntrianPoliController::class, 'panggilEkse'])->name('panggilEkse');
Route::get('/ekse/savepanggilEkse/{id}', [AntrianPoliController::class, 'savepanggilEkse'])->name('savepanggilEkse');
Route::get('/ekse/savependingEkse/{id}', [AntrianPoliController::class, 'savependingEkse'])->name('savependingEkse');
Route::get('/ekse/saveselesaiEkse/{id}', [AntrianPoliController::class, 'saveselesaiEkse'])->name('saveselesaiEkse');
Route::get('/ekse/display', [AntrianPoliController::class, 'displayEkse'])->name('displayEkse');

Route::get('/reg/input', [AntrianPoliController::class, 'showReg'])->name('showReg');
Route::post('/reg/save', [AntrianPoliController::class, 'saveReg'])->name('saveReg');
Route::get('/reg/panggil', [AntrianPoliController::class, 'panggilReg'])->name('panggilReg');
Route::get('/reg/savepanggilReg/{id}', [AntrianPoliController::class, 'savepanggilReg'])->name('savepanggilReg');
Route::get('/reg/savependingReg/{id}', [AntrianPoliController::class, 'savependingReg'])->name('savependingReg');
Route::get('/reg/saveselesaiReg/{id}', [AntrianPoliController::class, 'saveselesaiReg'])->name('saveselesaiReg');
Route::get('/reg/display', [AntrianPoliController::class, 'displayReg'])->name('displayReg');

Route::get('/test-broadcast-event', function () {
    ServerCreated::dispatch('Burhan ganteng');

    echo 'test broadcast event sangcahaya.id';
});
