<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\SaldoController;


// redirect awal
Route::get('/', function () {
    return redirect('/login');
});

// login (tidak perlu middleware)
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);

// ✅ register (bebas akses)
Route::get('/users/register', [UserController::class, 'create']);
Route::post('/users/register', [UserController::class, 'store']);



Route::get('/tambah-saldo', [SaldoController::class, 'formTambahSaldo']);
Route::post('/tambah-saldo', [SaldoController::class, 'tambahSaldo']);

// ✅ hanya untuk user login
Route::middleware('auth.login')->group(function () {

    Route::get('/dashboard', function () {
        return view('home');
    });

    Route::get('/logout', [AuthController::class, 'logout']); // 🔥 fix juga ini
});