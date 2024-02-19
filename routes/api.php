<?php

use App\Models\Page;
use App\Http\Controllers\API\v1\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::group(['prefix' => 'v1', 'middleware' => ['block.ip']], function () {

    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

        Route::get('/users', [UserController::class, 'index'])->withoutMiddleware('auth:sanctum');
        Route::get('/users/{CODUSUARIO}', [UserController::class, 'show'])->withoutMiddleware('auth:sanctum');
        Route::post('/users/{CODUSUARIO}/edit', [UserController::class, 'update'])->withoutMiddleware('auth:sanctum');
        Route::post('/users/create', [UserController::class, 'store'])->withoutMiddleware('auth:sanctum');
        Route::get('/users/delete/{CODUSUARIO}', [UserController::class, 'destroy'])->withoutMiddleware('auth:sanctum');

    });

});
