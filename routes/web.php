<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Admin

Route::get('admin',function(){return view('admin/auth/login');});