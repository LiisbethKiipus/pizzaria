<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    // Users Routes
    Route::group(['middleware' => ['permission:users.create']], function () {
        Route::resource('users', UserController::class)
            ->only(['create', 'store', 'show', 'index']);
    });
    Route::group(['middleware' => ['permission:users.edit']], function () {
        Route::resource('users', UserController::class)
            ->only(['edit', 'update', 'show', 'index']);
    });
    Route::group(['middleware' => ['permission:users.delete']], function () {
        Route::resource('users', UserController::class)
            ->only(['destroy', 'show', 'index']);
    });
    Route::group(['middleware' => ['permission:users.view']], function () {
        Route::resource('users', UserController::class)
            ->only(['show', 'index']);
    });

    //Roles Routes
    Route::group(['middleware' => ['permission:roles.create']], function () {
        Route::resource('roles', RoleController::class)
            ->only(['create', 'store', 'show', 'index']);
    });
    Route::group(['middleware' => ['permission:roles.edit']], function () {
        Route::resource('roles', RoleController::class)
            ->only(['edit', 'update', 'show', 'index']);
    });
    Route::group(['middleware' => ['permission:roles.delete']], function () {
        Route::resource('roles', RoleController::class)
            ->only(['destroy', 'show', 'index']);
    });
    Route::group(['middleware' => ['permission:roles.view']], function () {
        Route::resource('roles', RoleController::class)
            ->only(['show', 'index']);
    });

    //Items Routes
    Route::group(['middleware' => ['permission:items.create']], function () {
        Route::resource('items', ItemController::class)
            ->only(['create', 'store', 'show', 'index']);
    });
    Route::group(['middleware' => ['permission:items.edit']], function () {
        Route::resource('items', ItemController::class)
            ->only(['edit', 'update', 'show', 'index']);
    });
    Route::group(['middleware' => ['permission:items.delete']], function () {
        Route::resource('items', ItemController::class)
            ->only(['destroy', 'show', 'index']);
    });
    Route::group(['middleware' => ['permission:items.view']], function () {
        Route::resource('items', ItemController::class)
            ->only(['show', 'index']);
    });
});

require __DIR__ . '/settings.php';
