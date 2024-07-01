<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthControllers;
use App\Http\Controllers\admin\AdminControllers;
use App\Http\Controllers\admin\productControllers;
use App\Http\Controllers\admin\CategoryControllers;
use App\Http\Controllers\admin\DashboardControllers;
use App\Http\Controllers\admin\subCategoryControllers;

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

    //Admin List Handler
    Route::get('admin/admin/list',[AdminControllers::class,'list']);
    Route::get('admin/admin/add',[AdminControllers::class,'add']);
    Route::post('admin/admin/add',[AdminControllers::class,'insert']);
    Route::get('admin/admin/edit/{id}',[AdminControllers::class,'edit']);
    Route::post('admin/admin/edit/{id}',[AdminControllers::class,'update']);
    Route::get('admin/admin/delete/{id}',[AdminControllers::class,'delete']);

    //Category Handler
    Route::get('admin/category/list',[CategoryControllers::class,'list']);
    Route::get('admin/category/add',[CategoryControllers::class,'add']);
    Route::post('admin/category/add',[CategoryControllers::class,'insert']);
    Route::get('admin/category/edit/{id}',[CategoryControllers::class,'edit']);
    Route::post('admin/category/edit/{id}',[CategoryControllers::class,'update']);
    Route::get('admin/category/delete/{id}',[CategoryControllers::class,'delete']);

    //sub category
    Route::get('admin/subCategory/list',[subCategoryControllers::class,'list']);
    Route::get('admin/subCategory/add',[subCategoryControllers::class,'add']);
    Route::post('admin/subCategory/add',[subCategoryControllers::class,'insert']);
    Route::get('admin/subCategory/edit/{id}',[subCategoryControllers::class,'edit']);
    Route::post('admin/subCategory/edit/{id}',[subCategoryControllers::class,'update']);
    Route::get('admin/subCategory/delete/{id}',[subCategoryControllers::class,'delete']);

    //products
    Route::get('admin/products/list'  , [productControllers::class,'list']);
    Route::get('admin/products/add'   , [productControllers::class,'add']);
    Route::post('admin/products/add'  , [productControllers::class,'insert']);
    Route::get('admin/products/edit/{id}'  , [productControllers::class,'edit']);
    Route::post('admin/products/edit/{id}'  , [productControllers::class,'update']);
});