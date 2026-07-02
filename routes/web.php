<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\Api\V1\AuthController as V1AuthController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

use Illuminate\Support\Facades\Route;


Route::get("/", [HomeController::class, 'index'])->name('home');


Route::get("/admin/login", [AuthController::class, 'showLoginPage'])->name('login');
Route::post('/admin/login', [V1AuthController::class, 'login']);


Route::middleware('auth')->group( function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboardPage'])->name('dashboard'); 

});