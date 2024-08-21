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
use App\Http\Controllers\JournalsController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('checkAuth')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::get('/logout', [AuthController::class, 'logout']);
   
});

Route::middleware(['auth:api', 'checkAuth'])->group(function () {
    Route::apiResource('finance', FinanceGoalController::class);
    Route::apiResource('health', HealthGoalController::class);
    Route::apiResource('education', EducationGoalController::class);
    Route::apiResource('chats', ChatController::class);
    Route::apiResource('message', MessageController::class);
    Route::apiResource('emotions', EmotionsController::class);
    Route::apiResource('journal', JournalsController::class);
});

Route::get('/messages/{chat_id}', [MessageController::class, 'getMessagesByChatId']) ->middleware(['auth:api', 'checkAuth']);
Route::get('/user-journals', [JournalsController::class, 'userJournals'])->middleware(['auth:api', 'checkAuth']);