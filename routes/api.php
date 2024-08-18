<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FinanceGoalController;
use App\Http\Controllers\HealthGoalController;
use App\Http\Controllers\EducationGoalController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('checkAuth')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::get('/logout', [AuthController::class, 'logout']);
   
});

Route::apiResource('finance', FinanceGoalController::class)
    ->middleware(['auth:api', 'checkAuth']);
Route::apiResource('health', HealthGoalController::class)
    ->middleware(['auth:api', 'checkAuth']);
Route::apiResource('education', EducationGoalController::class)
    ->middleware(['auth:api', 'checkAuth']);