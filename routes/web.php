<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

// Home Route
Route::get('/', function () {
    return view('welcome');
});

// Guest Routes
Route::middleware('guest')->group(function () {

    // Registration
    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register']);

    // Login
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login']);

});

// Authenticated Routes
Route::middleware('auth')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    // Student Routes
    Route::resource('students', StudentController::class);

    // Course Routes
    Route::resource('courses', CourseController::class);

});
