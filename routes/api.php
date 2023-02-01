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

Route::group(['middleware' =>['auth:sanctum']], function () {
    Route::post('/logout', [Authcontroller::class, 'logout']);
});

Route::post('/register', [Authcontroller::class, 'Signup']);
Route::post('/login', [Authcontroller::class, 'sign_in']);
