<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Models\Folio;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/consulta', [HomeController::class, 'mostrarOrden'])->name('home.consulta');
Route::get('/buscar-orden', [HomeController::class, 'buscarOrden'])->name('home.buscar_orden');
