<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ArsipController;
use App\Http\Controllers\Api\KategorisuratController;
use App\Http\Controllers\Api\KategorisuratArsipsController;

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

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('users', UserController::class);

        Route::apiResource('kategorisurats', KategorisuratController::class);

        // Kategorisurat Arsips
        Route::get('/kategorisurats/{kategorisurat}/arsips', [
            KategorisuratArsipsController::class,
            'index',
        ])->name('kategorisurats.arsips.index');
        Route::post('/kategorisurats/{kategorisurat}/arsips', [
            KategorisuratArsipsController::class,
            'store',
        ])->name('kategorisurats.arsips.store');

        Route::apiResource('arsips', ArsipController::class);
    });
