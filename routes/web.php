<?php

use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Models\Folio;

Route::get('/welcome', [WelcomeController::class, 'index'])->name('welcome');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/consulta', [HomeController::class, 'mostrarOrden'])->name('home.consulta');
Route::get('/buscar-orden', [HomeController::class, 'buscarOrden'])->name('home.buscar_orden');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
