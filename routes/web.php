<?php

use App\Http\Controllers\Area\IndexController as AreaController;
use App\Http\Controllers\Area\LoginController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', IndexController::class)->name('index');

Route::get('area3/login', [LoginController::class, 'index'])->name('area.login');
Route::post('area3/login', [LoginController::class, 'login']);
Route::get('area3/logout', [LoginController::class, 'logout']);

Route::get('area3/{page?}', AreaController::class)->middleware('auth')->where('page', '.*')->name('area.index');
