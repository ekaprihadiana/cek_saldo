<?php

<<<<<<< HEAD
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('home'); // nanti kita buat view 'home.blade.php'
=======
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\UserController;

// redirect awal
Route::get('/', function () {
    return redirect('/login');
});

// login (tidak perlu middleware)
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);

// register (bebas akses)
Route::get('/users/register', [UserController::class, 'create']);
Route::post('/users/register', [UserController::class, 'store']);

// logout & dashboard (WAJIB login)
Route::middleware('auth.login')->group(function () {

    Route::get('/dashboard', function () {
        return view('home');
    });
    Route::get('/users/register', [UserController::class, 'create']);
Route::post('/users/register', [UserController::class, 'store']);

    Route::get('/logout', [AuthController::class, 'logout']);
>>>>>>> b66c4fcd402bf8fe48b69164ba75aa7c991b9709
});