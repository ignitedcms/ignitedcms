<?php

use Ignitedcms\Ignitedcms\Http\Controllers\ContactController;

Route::get('contact', [ContactController::class, 'index']);