<?php


use Ignitedcms\Ignitedcms\Http\Controllers\ContactController;
Route::middleware('web')->get('contact', [ContactController::class, 'index']);