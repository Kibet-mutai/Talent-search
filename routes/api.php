<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\FreelanceController;

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

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', [FreelanceController::class, 'view_profile']);
    Route::post('/profile/create', [FreelanceController::class, 'create_profile']);
    Route::put('/profile/edit/{id}', [FreelanceController::class, 'update_profile']);
    Route::post('/profile/delete/{id}', [FreelanceController::class, 'delete_profile']);
    Route::get('/profile/{id}', [FreelanceController::class, 'profile_detail']);


    // Employers Routes

   
    Route::post('/employer/create', [EmployerController::class, 'store']);
    Route::delete('/employer/delete/{id}', [EmployerController::class, 'destroy']);
    Route::get('/employer{id}', [EmployerController::class, 'show']);

    Route::post('/logout', [Authcontroller::class, 'logout']);
});

Route::post('/register', [Authcontroller::class, 'Signup']);
Route::post('/login', [Authcontroller::class, 'sign_in']);
