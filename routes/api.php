<?php

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

Route::get('/getcars', [\App\Http\Controllers\CarController::class, 'getCars']);
Route::post('/addcar', [\App\Http\Controllers\CarController::class, 'addCar']);
Route::get('/getcar/{id}', [\App\Http\Controllers\CarController::class, 'getCar']);
