<?php

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
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');

    // Users Routes
    Route::group(['middleware' => ['permission:users.create']], function () {
        Route::resource('users', RoleController::class)
            ->only(['create', 'store', 'show', 'index']);
    });
    Route::group(['middleware' => ['permission:users.edit']], function () {
        Route::resource('users', RoleController::class)
            ->only(['edit', 'update', 'show', 'index']);
    });
    Route::group(['middleware' => ['permission:users.destroy']], function () {
        Route::resource('users', RoleController::class)
            ->only(['destroy', 'show', 'index']);
    });
    Route::group(['middleware' => ['permission:users.view']], function () {
        Route::resource('users', RoleController::class)
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
    Route::group(['middleware' => ['permission:roles.destroy']], function () {
        Route::resource('roles', RoleController::class)
            ->only(['destroy', 'show', 'index']);
    });
    Route::group(['middleware' => ['permission:roles.view']], function () {
        Route::resource('roles', RoleController::class)
            ->only(['show', 'index']);
    });
});
require __DIR__ . '/settings.php';
