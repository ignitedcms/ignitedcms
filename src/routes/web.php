<?php


use Ignitedcms\Ignitedcms\Http\Controllers\ContactController;
use Ignitedcms\Ignitedcms\Http\Controllers\admin\InstallController;
use Ignitedcms\Ignitedcms\Http\Controllers\admin\LoginController;

Route::middleware('web')->get('contact', [ContactController::class, 'index']);

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