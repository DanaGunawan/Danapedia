<?php

use App\Http\Controllers\admin\DashboardControllers;
use App\Http\Controllers\AuthControllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminControllers;

Route::get('/', function () {
    return view('welcome');
});

//admin login
Route::group(['middleware' => 'AdminSudahLogin'], function(){
    Route::get('/admin',[AuthControllers::class, 'login_admin']);
    Route::post('/admin',[AuthControllers::class, 'auth_login_admin']);
});
//adminLogout
Route::get('admin/logout',[AuthControllers::class, 'logout_admin']);



// Admin Setelah login
Route::group(['middleware' => 'AdminMiddleware'], function(){
    Route::get('admin/dashboard', [DashboardControllers::class,'dashboard']);

    //Admin List
    Route::get('admin/admin/list',[AdminControllers::class,'list']);
    Route::get('admin/admin/add',[AdminControllers::class,'add']);
    Route::post('admin/admin/add',[AdminControllers::class,'insert']);
    Route::get('admin/admin/edit/{id}',[AdminControllers::class,'edit']);
    Route::post('admin/admin/edit/{id}',[AdminControllers::class,'update']);
    Route::get('admin/admin/delete/{id}',[AdminControllers::class,'delete']);

});