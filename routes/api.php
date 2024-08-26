<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AppController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ContentsController;
use App\Http\Controllers\Api\TransactionController;

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


Route::post('/login/splash', [LoginController::class, 'splash']);

Route::post('/cont/stage', [ContentsController::class, 'stage']);

Route::post('/trans/payment', [TransactionController::class, 'payment']);
