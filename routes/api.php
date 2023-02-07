<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\FreelanceController;
use App\Http\Controllers\HireFreelancerController;

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

    Route::group(['prefix' => 'freelancer'], function () {
        Route::get('/profile', [FreelanceController::class, 'view_profile']);
        Route::post('/create', [FreelanceController::class, 'create_profile']);
        Route::put('/edit/{id}', [FreelanceController::class, 'update_profile']);
        Route::post('/delete/{id}', [FreelanceController::class, 'delete_profile']);
        Route::get('/{id}', [FreelanceController::class, 'profile_detail']);
    }
    );




    // Employers Routes

    Route::group(['prefix' => 'employer'], function () {
        Route::get('/profile', [EmployerController::class, 'index']);
        Route::post('/create', [EmployerController::class, 'store']);
        Route::delete('/delete/{id}', [EmployerController::class, 'destroy']);
        Route::get('/{id}', [EmployerController::class, 'show']);

        Route::post('/hire_freelancer', [HireFreelancerController::class, 'hireFreelancer']);
    }
    );


    Route::post('/logout', [Authcontroller::class, 'logout']);

});

//search
Route::get('/search', [FreelanceController::class, 'search'])->middleware(['auth:sanctum']);
Route::post('review', [ReviewController::class, 'create_review'])->middleware(['auth:sanctum']);
Route::post('/register', [Authcontroller::class, 'Signup']);
Route::post('/login', [Authcontroller::class, 'sign_in']);
