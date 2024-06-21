<?php

use App\Http\Controllers\AuthControllers;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

//admin login
Route::get('/admin',[AuthControllers::class, 'login_admin']);
Route::post('/admin',[AuthControllers::class, 'auth_login_admin']);
Route::get('admin/logout',[AuthControllers::class, 'logout_admin']);


// Admin Setelah login
Route::group(['middleware' => 'AdminMiddleware'], function(){
    Route::get('admin/dashboard',function(){return view('admin/dashboard');});
    Route::get('admin/list',function(){return view('admin/admin/list');});

});