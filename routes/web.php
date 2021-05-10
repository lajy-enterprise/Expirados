<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/buscar', [App\Http\Controllers\HomeController::class, 'AbrirBuscar'])->name('AbrirBuscar');

Route::post('/buscar', [App\Http\Controllers\HomeController::class, 'BuscarEnlaces'])->name('Buscar');

Route::get('/procesados', [App\Http\Controllers\HomeController::class, 'procesados'])->name('procesados');

Route::post('/procesados', [App\Http\Controllers\HomeController::class, 'procesados']);