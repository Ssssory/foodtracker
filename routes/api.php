<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\RestourantController;
use Illuminate\Http\Request;
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

Route::resource('restoutant', RestourantController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
Route::resource('point', PointController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
Route::resource('order', OrderController::class)->only(['index', 'store', 'show', 'update', 'destroy']);


