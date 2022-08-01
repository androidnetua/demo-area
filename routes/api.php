<?php

use App\Http\Controllers\Area\SpecsController;
use App\Http\Controllers\Area\SpecsCpuController;
use App\Http\Controllers\Area\SpecsGpuController;
use App\Http\Controllers\Area\UsersController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth')->group(function (){
    Route::get('user', [UsersController::class, 'user']);
    Route::post('user/password', [UsersController::class, 'password']);
});

Route::middleware(['auth', 'activated'])->group(function (){

    Route::middleware('permissions:manage-users')->group(function (){
        Route::apiResource('users', UsersController::class)->whereNumber('user');
        Route::get('permissions', \App\Http\Controllers\Area\PermissionsController::class);
    });

    Route::middleware('permissions:specs')->group(function (){
        Route::get('specs/vendors', [SpecsController::class, 'vendors']);

        Route::get('specs/cpu/params', [SpecsCpuController::class, 'params']);
        Route::apiResource('specs/cpu', SpecsCpuController::class)
            ->whereNumber('cpu')
            ->parameter('cpu', 'device');

        Route::get('specs/gpu/params', [SpecsGpuController::class, 'params']);
        Route::apiResource('specs/gpu', SpecsGpuController::class)
            ->whereNumber('gpu')
            ->parameter('gpu', 'device');
    });

});
