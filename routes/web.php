<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

use App\Http\Middleware\CheckRole; // Make sure to import your middleware



Route::get('/', function () {
    return view('welcome');
});



Route::get('/contactus', [GuestController::class, 'contactus'])->name('contactus.index');

Route::get('/privacy', [GuestController::class, 'privacy'])->name('privacy.index');

Route::get('/creator', [GuestController::class, 'creator'])->name('creator.index');

Route::get('/website', [GuestController::class, 'website'])->name('website.index');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/recipe', [UserController::class, 'showRecipe'])->name('recipe');
    Route::get('/submitrecipe', [UserController::class, 'submitRecipe'])->name('submitrecipe');
   Route::match(['get', 'post'], '/province', [UserController::class, 'showProvince'])
        ->name('province');

    Route::match(['get', 'post'], '/users/store', [UserController::class, 'store'])->name('users.store');

        Route::middleware(CheckRole::class)->group(function () {
            Route::get('/create', [AdminController::class, 'create'])->name('create.index');
            Route::get('/edit', [AdminController::class, 'edit'])->name('edit.index');
            Route::get('/index', [AdminController::class, 'index'])->name('index.index');
            Route::post('/admin/approve/{id}', [AdminController::class, 'approve'])->name('admin.approve');
            Route::post('/admin/recipe/{id}/remove', [AdminController::class, 'remove'])->name('admin.recipe.remove');
            Route::get('/admin/recipe/{id}/edit', [AdminController::class, 'edit'])->name('edit.index');
            Route::put('/recipes/{id}', [AdminController::class, 'update'])->name('recipes.update');

        });

});