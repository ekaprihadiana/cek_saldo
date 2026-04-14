<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/tambah-saldo', [AuthController::class, 'tambahSaldo']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/saldo/{username}', [AuthController::class, 'cekSaldo']);
Route::post('/lupa-password', [AuthController::class, 'lupaPassword']);