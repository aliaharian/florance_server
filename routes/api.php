<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/migrate', function(){
    \Artisan::call('migrate');
    dd('migrated!');
});
Route::group(['prefix' => 'user'], function () {
    Route::post('/setTransaction', [UserController::class, 'setTransaction'])->name('user.setTransaction');
    Route::post('/sendCode', [UserController::class, 'sendCode'])->name('user.sendCode');

});

