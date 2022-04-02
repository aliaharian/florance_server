<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\TicketController;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\SetFa;
use App\Http\Middleware\VerifyPhone;

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
Route::group(['middleware' => [SetFa::class]], function () {
    Route::group(['middleware' => [Authenticate::class, VerifyPhone::class]], function () {
        Route::get('/', [WebsiteController::class, 'index'])->name('index');
        //orders
        Route::group(['prefix' => 'orders'], function () {
            Route::get('/', [OrderController::class, 'index'])->name('orders.index');
            Route::get('/create', [OrderController::class, 'create'])->name('orders.create');
            Route::post('/store', [OrderController::class, 'store'])->name('orders.store');
            Route::get('/edit/{order}', [OrderController::class, 'edit'])->name('orders.edit');
            Route::get('/{order}', [OrderController::class, 'view'])->name('orders.view');
            Route::get('/changeState/{order}', [OrderController::class, 'changeState'])->name('orders.changeState');
            Route::put('/edit/{order}', [OrderController::class, 'update'])->name('orders.update');
            Route::get('/pay/{order}', [OrderController::class, 'payList'])->name('orders.payList');
            Route::put('/changeState/{order}', [OrderController::class, 'submitChangeState'])->name('orders.submitChangeState');
            Route::delete('/destroy/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
        });

        //payments
        Route::group(['prefix' => 'payments'], function () {
            Route::get('/', [PaymentsController::class, 'index'])->name('payments.index');
        });

        //tickets
        Route::group(['prefix' => 'tickets'], function () {
            Route::get('/', [TicketController::class, 'index'])->name('tickets.index');
            Route::get('/create', [TicketController::class, 'create'])->name('tickets.create');
            Route::get('/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
            Route::post('/create', [TicketController::class, 'store'])->name('tickets.store');
            Route::post('/sendMessage/{ticket}', [TicketController::class, 'sendMessage'])->name('tickets.sendMessage');
            Route::get('/close/{ticket}', [TicketController::class, 'close'])->name('tickets.close');


            Route::group(['middleware' => [isAdmin::class]], function () {
                Route::get('/pend/{ticket}', [TicketController::class, 'pend'])->name('tickets.pend');
            });
        });

        //users management
        Route::group(['prefix' => 'users'], function () {
            Route::put('/update/{user}', [UserController::class, 'update'])->name('users.update');

            //profile management
            Route::group(['prefix' => 'profile'], function () {
                Route::get('/', [UserController::class, 'profile'])->name('users.profile');

                //addresses management
                Route::group(['prefix' => 'addresses'], function () {
                    Route::get('/', [UserController::class, 'addresses'])->name('profile.addresses');
                    Route::get('/create', [UserController::class, 'createAddress'])->name('addresses.create');
                    Route::post('/store', [UserController::class, 'storeAddress'])->name('addresses.store');
                    Route::get('/edit/{address}', [UserController::class, 'editAddress'])->name('addresses.edit');
                    Route::put('/edit/{address}', [UserController::class, 'updateAddress'])->name('addresses.update');
                    Route::delete('/destroy/{address}', [UserController::class, 'deleteAddress'])->name('addresses.destroy');
                });
            });


            //admin user management
            Route::group(['middleware' => [isAdmin::class]], function () {
                Route::get('/list', [UserController::class, 'list'])->name('users.list');
                Route::get('/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
                Route::delete('/destroy/{user}', [UserController::class, 'destroy'])->name('users.destroy');

                //admin addresses management
                Route::group(['prefix' => 'addresses'], function () {
                    Route::get('/{user}', [UserController::class, 'addresses'])->name('user.addresses');
                    Route::get('/{user}/create', [UserController::class, 'createAddress'])->name('userAddresses.create');
                    Route::post('/{user}/store', [UserController::class, 'storeAddress'])->name('userAddresses.store');
                    Route::get('/{user}/edit/{address}', [UserController::class, 'editAddress'])->name('userAddresses.edit');
                    Route::put('/{user}/edit/{address}', [UserController::class, 'updateAddress'])->name('userAddresses.update');
                    Route::delete('/{user}/destroy/{address}', [UserController::class, 'deleteAddress'])->name('userAddresses.destroy');
                });
            });

        });



        Route::group(['middleware' => [isAdmin::class]], function () {

            //colors management
            Route::group(['prefix' => 'colors'], function () {
                Route::get('/', [ColorController::class, 'index'])->name('colors.index');
                Route::post('/store', [ColorController::class, 'store'])->name('colors.store');
                Route::get('/edit/{color}', [ColorController::class, 'edit'])->name('colors.edit');
                Route::get('/search', [ColorController::class, 'search'])->name('colors.search');
                Route::put('/edit/{color}', [ColorController::class, 'update'])->name('colors.update');
                Route::delete('/edit/{color}', [ColorController::class, 'destroy'])->name('colors.destroy');
            });

            //materials management
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
    Route::post('/resetPassword', [UserController::class, 'resetPassword'])->name('user.resetPassword');

    Route::group(['middleware' => [Authenticate::class]], function () {
        Route::get('/verifyPhone', [UserController::class, 'verifyPhone'])->name('user.verifyPhone');
        Route::post('/verifyPhone', [UserController::class, 'verifyCode'])->name('user.verifyCode');
    });
});
Route::get('/getCities/{id}/{selected?}', [WebsiteController::class, 'getCities'])->name('website.getCities');

