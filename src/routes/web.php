<?php


use Ignitedcms\Ignitedcms\Http\Controllers\admin\InstallController;
use Ignitedcms\Ignitedcms\Http\Controllers\admin\LoginController;
use Ignitedcms\Ignitedcms\Http\Controllers\admin\DashboardController;
use Ignitedcms\Ignitedcms\Http\Controllers\admin\ProfileController;
use Ignitedcms\Ignitedcms\Http\Controllers\admin\UserController;


Route::middleware('web')->group(function () {
    Route::get('/installer', [InstallController::class, 'index']);
    Route::get('/installer/db', [InstallController::class, 'bar']);
    Route::get('/installer/terms', [InstallController::class, 'one']);
    Route::get('/installer/register', [InstallController::class, 'two']);
    Route::post('/installer/validate_form', [InstallController::class, 'validate_form']);
});

Route::middleware('web')->group(function () {
//Login
    Route::get('/login', [LoginController::class, 'index']);
    Route::get('/logout', [LoginController::class, 'logout']);
    Route::post('/login/validate_login', [LoginController::class, 'validate_login']);

});

//Dashboard

Route::middleware('web')->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index']);
});

//Profile
Route::middleware('web')->group(function () {
   Route::get('/admin/profile', [ProfileController::class, 'index']);
   Route::post('/admin/profile/update', [ProfileController::class, 'update']);
});

//users

Route::middleware('web')->group(function () {
   Route::get('/admin/users', [UserController::class, 'index']);
   Route::get('/admin/users/create', [UserController::class, 'create_view']);
   Route::post('/admin/users/create', [UserController::class, 'create']);
   Route::get('/admin/users/update/{id}', [UserController::class, 'update_view']);
   Route::post('/admin/users/update/{id}', [UserController::class, 'update']);
   Route::post('/admin/users/delete/{id}', [UserController::class, 'destroy']);

});
