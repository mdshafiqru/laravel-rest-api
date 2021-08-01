<?php

use App\Http\Controllers\AuthController;
// Route for class
Route::ApiResource('/class', 'App\Http\Controllers\Api\SclassController');

// Route for subject
Route::ApiResource('/subject', 'App\Http\Controllers\Api\SubjectController');

// Route for section
Route::ApiResource('/section', 'App\Http\Controllers\Api\SectionController');

// Route for Student
Route::ApiResource('/student', 'App\Http\Controllers\Api\StudentController');


// JWT Authentication routes
Route::group([

    // 'middleware' => 'api',
    'prefix' => 'auth'

], function () {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
    Route::post('register', [AuthController::class, 'register']);

});