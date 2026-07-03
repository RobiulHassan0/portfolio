<?php

use App\Http\Controllers\Api\V1\AboutsController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ContactsController;
use App\Http\Controllers\Api\V1\MessagesController;
use App\Http\Controllers\Api\V1\PersonalInfoController;
use App\Http\Controllers\Api\V1\ProjectsController;
use App\Http\Controllers\Api\V1\ServicesController;
use App\Http\Controllers\Api\V1\SkillsController;
use Illuminate\Support\Facades\Route;


Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::apiResource('profile', PersonalInfoController::class);

    Route::apiResource('projects', ProjectsController::class);

    Route::apiResource('skills', SkillsController::class);
    
    Route::patch('/skills/{id}/toggle-status', [SkillsController::class, 'toggleStatus']);

    Route::apiResource('abouts', AboutsController::class);

    Route::apiResource('services', ServicesController::class);

    Route::apiResource('contacts', ContactsController::class); 

    Route::apiResource('messages', MessagesController::class);

});