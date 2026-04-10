<?php

use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('home'); // nanti kita buat view 'home.blade.php'
});