<?php

use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Models\Folio;

Route::get('/welcome', [WelcomeController::class, 'index'])->name('welcome');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/consulta', [HomeController::class, 'mostrarOrden'])->name('home.consulta');
Route::get('/buscar-orden', [HomeController::class, 'buscarOrden'])->name('home.buscar_orden');

Route::get('/register', [AuthController::class, 'registerForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/orders', [OrderController::class, 'index'])->name('orders');
Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
Route::get('/orders/get_by_tipo_unidad', [OrderController::class, 'get_by_tipo_unidad'])->name('orders.get_by_tipo_unidad');

Route::get('/rutas/{id}/colonias', [OrderController::class, 'getColonias']);

Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');