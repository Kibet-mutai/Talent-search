<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
    Route::get('/profile', [FreelancerController::class, 'view_profile']);
    Route::post('/profile/create', [FreelancerController::class, 'create_profile']);
    Route::post('/profile/edit/{id}', [FreelancerController::class, 'update_profile']);
    Route::post('/profile/delete/{id}', [FreelancerController::class, 'delete_profile']);
    Route::get('/profile/{id}', [FreelancerController::class, 'profile_detail']);

    Route::post('/logout', [Authcontroller::class, 'logout']);
});

Route::post('/register', [Authcontroller::class, 'Signup']);
Route::post('/login', [Authcontroller::class, 'sign_in']);
