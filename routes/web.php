<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KelasController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('siswa', SiswaController::class);
Route::resource('kelas', KelasController::class, [
    'parameters' => [
        'kelas' => 'kelas'
    ]
]);
Route::post('kelas-restore/{kelas}', [KelasController::class, 'restore'])->name('kelas.restore');
