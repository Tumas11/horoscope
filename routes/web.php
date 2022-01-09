<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DateController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create', [DateController::class, 'create'])->name('create');
Route::post('/store', [DateController::class, 'store'])->name('store');
Route::get('/', [DateController::class, 'index'])->name('index');
Route::get('/show{sign}', [DateController::class, 'show'])->name('show');
Route::get('/horoscope{id}', [DateController::class, 'horoscope'])->name('horoscope');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
