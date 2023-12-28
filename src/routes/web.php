<?php

use Ignitedcms\Ignitedcms\Http\Controllers\admin\AssetController;
use Ignitedcms\Ignitedcms\Http\Controllers\admin\DashboardController;
use Ignitedcms\Ignitedcms\Http\Controllers\admin\DatabaseController;
use Ignitedcms\Ignitedcms\Http\Controllers\admin\EntryController;
use Ignitedcms\Ignitedcms\Http\Controllers\admin\FieldsController;
use Ignitedcms\Ignitedcms\Http\Controllers\admin\InstallController;
use Ignitedcms\Ignitedcms\Http\Controllers\admin\LoginController;
use Ignitedcms\Ignitedcms\Http\Controllers\admin\MatrixController;
use Ignitedcms\Ignitedcms\Http\Controllers\admin\MultipleController;
use Ignitedcms\Ignitedcms\Http\Controllers\admin\PermissionController;
use Ignitedcms\Ignitedcms\Http\Controllers\admin\ProfileController;
use Ignitedcms\Ignitedcms\Http\Controllers\admin\SectionController;
use Ignitedcms\Ignitedcms\Http\Controllers\admin\UserController;
use Ignitedcms\Ignitedcms\Models\admin\Router;

//Installer
Route::middleware('web')->group(function () {
    Route::get('/installer', [InstallController::class, 'index']);
    Route::get('/installer/db', [InstallController::class, 'bar']);
    Route::get('/installer/terms', [InstallController::class, 'one']);
    Route::get('/installer/register', [InstallController::class, 'two']);
    Route::post('/installer/validate_form', [InstallController::class, 'validateForm']);
});

//matrix
Route::middleware('web')->group(function () {
    Route::get('/admin/matrix/create', [MatrixController::class, 'createView']);
    Route::post('/admin/matrix/create', [MatrixController::class, 'create']);
    Route::post('/admin/matrix/add_matrix_block', [MatrixController::class, 'addMatrixBlock']);
    Route::post('/admin/matrix/add_matrix_block2', [MatrixController::class, 'addMatrixBlock2']);
});

//assets
Route::middleware('web')->group(function () {
    Route::get('/admin/assets', [AssetController::class, 'index']);
    Route::get('/admin/assets/create', [AssetController::class, 'createView']);
    Route::post('/admin/assets/create', [AssetController::class, 'create']);
    Route::get('/admin/assets/update/{id}', [AssetController::class, 'updateView']);
    Route::post('/admin/assets/delete/{id}', [AssetController::class, 'destroy']);
});

Route::middleware('web')->group(function () {
    //Login
    Route::get('/login', [LoginController::class, 'index']);
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::post('/login/validate_login', [LoginController::class, 'validateLogin']);

});

//Dashboard

Route::middleware('web')->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index']);
});

//Database

Route::middleware('web')->group(function () {
    Route::get('/admin/database', [DatabaseController::class, 'index']);
    Route::post('/admin/database/backup', [DatabaseController::class, 'backup']);
});

//Profile
Route::middleware('web')->group(function () {
    Route::get('/admin/profile', [ProfileController::class, 'index']);
    Route::post('/admin/profile/update', [ProfileController::class, 'update']);
    Route::get('/admin/profile/password', [ProfileController::class, 'passwordView']);
    Route::post('/admin/profile/password', [ProfileController::class, 'password']);
});

//users

Route::middleware('web')->group(function () {
    Route::get('/admin/users', [UserController::class, 'index']);
    Route::get('/admin/users/create', [UserController::class, 'createView']);
    Route::post('/admin/users/create', [UserController::class, 'create']);
    Route::get('/admin/users/update/{id}', [UserController::class, 'updateView']);
    Route::post('/admin/users/update/{id}', [UserController::class, 'update']);
    Route::post('/admin/users/delete/{id}', [UserController::class, 'destroy']);

});

Route::middleware('web')->group(function () {
    //Permissions
    Route::get('/admin/permissions', [PermissionController::class, 'index']);
    Route::get('/admin/permissions/create', [PermissionController::class, 'createView']);
    Route::post('/admin/permissions/create', [PermissionController::class, 'create']);
    Route::get('/admin/permissions/update/{id}', [PermissionController::class, 'updateView']);
    Route::post('/admin/permissions/update/{id}', [PermissionController::class, 'update']);
    Route::post('/admin/permissions/delete/{id}', [PermissionController::class, 'destroy']);

});

//Fields
Route::middleware('web')->group(function () {
    Route::get('/admin/fields', [FieldsController::class, 'index']);
    Route::get('/admin/fields/create', [FieldsController::class, 'createView']);
    Route::post('/admin/fields/create', [FieldsController::class, 'create']);
    Route::get('/admin/fields/update/{id}', [FieldsController::class, 'updateView']);
    Route::post('/admin/fields/delete/{id}', [FieldsController::class, 'destroy']);

});

//Sections

Route::middleware('web')->group(function () {
    Route::get('/admin/section', [SectionController::class, 'index']);
    Route::get('/admin/section/create', [SectionController::class, 'createView']);
    Route::post('/admin/section/create', [SectionController::class, 'create']);
    Route::get('/admin/section/update/{id}', [SectionController::class, 'updateView']);
    Route::post('/admin/section/update/{id}', [SectionController::class, 'update']);
    Route::post('/admin/section/delete/{id}', [SectionController::class, 'destroy']);

});

//Entries

Route::middleware('web')->group(function () {
    Route::get('/admin/entry', [EntryController::class, 'index']);
    Route::get('/admin/entry/update/{sid}/{eid}', [EntryController::class, 'updateView']);

    //quick content test
    Route::post('/admin/entry/save/{sid}/{eid}', [EntryController::class, 'update']);

    //template generator to do make post request
    Route::get('/admin/entry/build_single/{sid}/{eid}', [EntryController::class, 'buildSingle']);
    Route::get('/admin/entry/build_multiple/{sid}', [EntryController::class, 'buildMultiple']);

    //template removal make post request

    // Multiples
    Route::get('/admin/multiple/{sid}', [MultipleController::class, 'index']);
    Route::post('/admin/multiple/create/{sid}', [MultipleController::class, 'create']);
    Route::get('/admin/multiple/update/{sid}/{eid}', [MultipleController::class, 'updateView']);
    Route::post('/admin/multiple/delete/{sid}', [MultipleController::class, 'destroy']);
    Route::post('/admin/multiple/order_multiples', [MultipleController::class, 'orderMultiples']);

});

//Where the magic happens
//Router::get_routes();
