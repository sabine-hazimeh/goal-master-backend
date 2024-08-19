<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FinanceGoalController;
use App\Http\Controllers\HealthGoalController;
use App\Http\Controllers\EducationGoalController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\EmotionsController;

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
Route::apiResource('chats', ChatController::class)
    ->middleware(['auth:api', 'checkAuth']);
Route::apiResource('message', MessageController::class)
    ->middleware(['auth:api', 'checkAuth']);

Route::get('/messages/{chat_id}', [MessageController::class, 'getMessagesByChatId']);
Route::apiResource('emotions', EmotionsController::class)
    ->middleware(['auth:api', 'checkAuth']);
Route::apiResource('journal', EmotionsController::class)
    ->middleware(['auth:api', 'checkAuth']);