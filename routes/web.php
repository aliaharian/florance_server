<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\MaterialController;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\Authenticate;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => [Authenticate::class]], function () {
    Route::get('/', [WebsiteController::class, 'index'])->name('index');
    Route::group(['prefix' => 'orders'], function () {
        Route::get('/', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/create', [OrderController::class, 'create'])->name('orders.create');
        Route::post('/store', [OrderController::class, 'store'])->name('orders.store');
        Route::get('/edit/{order}', [OrderController::class, 'edit'])->name('orders.edit');
        Route::delete('/destroy/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
    });

    Route::group(['middleware' => [isAdmin::class]], function () {
        Route::group(['prefix' => 'colors'], function () {
            Route::get('/', [ColorController::class, 'index'])->name('colors.index');
            Route::post('/store', [ColorController::class, 'store'])->name('colors.store');
            Route::get('/edit/{color}', [ColorController::class, 'edit'])->name('colors.edit');
            Route::get('/search', [ColorController::class, 'search'])->name('colors.search');
            Route::put('/edit/{color}', [ColorController::class, 'update'])->name('colors.update');
            Route::delete('/edit/{color}', [ColorController::class, 'destroy'])->name('colors.destroy');
        });
        Route::group(['prefix' => 'materials'], function () {
            Route::get('/', [MaterialController::class, 'index'])->name('materials.index');
            Route::post('/store', [MaterialController::class, 'store'])->name('materials.store');
            Route::get('/edit/{material}', [MaterialController::class, 'edit'])->name('materials.edit');
            Route::get('/search', [MaterialController::class, 'search'])->name('materials.search');
            Route::put('/edit/{material}', [MaterialController::class, 'update'])->name('materials.update');
            Route::delete('/edit/{material}', [MaterialController::class, 'destroy'])->name('materials.destroy');
        });
    });
});


Auth::routes();

Route::get('/getCities/{id}', [WebsiteController::class, 'getCities'])->name('website.getCities');

