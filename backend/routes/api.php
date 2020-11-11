<?php

use App\Http\Controllers\HouseController;
use App\Http\Controllers\HouseFilterInfoController;
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

Route::resource('/houses', HouseController::class)->only('index');
Route::resource('/info', HouseFilterInfoController::class)->only('index');
