<?php


use Ignitedcms\Ignitedcms\Http\Controllers\ContactController;
use Ignitedcms\Ignitedcms\Http\Controllers\InstallController;

Route::middleware('web')->get('contact', [ContactController::class, 'index']);


Route::get('/installer', [InstallController::class, 'index']);
Route::get('/installer/db', [InstallController::class, 'bar']);
Route::get('/installer/terms', [InstallController::class, 'one']);
Route::get('/installer/register', [InstallController::class, 'two']);
Route::post('/installer/validate_form', [InstallController::class, 'validate_form']);