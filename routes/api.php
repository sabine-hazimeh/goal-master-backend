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
use App\Http\Controllers\CourseraController;

Route::post('/register', [AuthController::class, 'registerUser']);
Route::post('/register/consultant', [AuthController::class, 'registerConsultant'])->middleware(['auth:api', 'admin']);

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:api')->group(function () {
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
    Route::get('/messages/{chat_id}', [MessageController::class, 'getMessagesByChatId']);
    Route::get('/user-journals', [JournalsController::class, 'userJournals']);
    Route::post('/chat', [ChatController::class, 'getOrCreateChat']);
    Route::get('/chat/{chat_id}/messages', [ChatController::class, 'getMessages']);
    Route::apiResource('coursera', CourseraController::class);
    Route::get('/goals', [EducationGoalController::class, 'DisplayEducationGoal']);
    Route::get('/coursera/education/{education_id}', [CourseraController::class, 'getCoursesByEducationId']);
});

Route::get('users', [AuthController::class, 'DisplayUsers'])->middleware(['auth:api', 'consultants']);
Route::middleware(['auth:api', 'checkAuth'])->post('/profile', [AuthController::class, 'updateUser']);
Route::get('consultants', [AuthController::class, 'DisplayConsultants'])->middleware('auth:api');
Route::delete('/consultants/{id}', [AuthController::class, 'deleteConsultant'])->middleware('auth:api');
Route::middleware(['auth:api', 'admin'])->get('/consultants/{id}', [AuthController::class, 'show']);
Route::middleware('auth:api')->post('/consultants/{id}', [AuthController::class, 'updateConsultant']);
