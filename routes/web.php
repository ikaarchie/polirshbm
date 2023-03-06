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

Route::get('/input', [AntrianPoliController::class, 'show'])->name('show');
Route::post('/save', [AntrianPoliController::class, 'save'])->name('save');
Route::get('/panggil', [AntrianPoliController::class, 'panggil'])->name('panggil');
Route::get('/savepanggil/{id}', [AntrianPoliController::class, 'savepanggil'])->name('savepanggil');
Route::get('/display', [AntrianPoliController::class, 'display'])->name('display');

Route::get('/test-broadcast-event', function () {
    ServerCreated::dispatch('Burhan ganteng');
    
    echo 'test broadcast event sangcahaya.id';
});