<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

use App\Http\Controllers\AuthController;   
use App\Http\Controllers\StaffController; 

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // 1. Rutas de administración
    Route::apiResource('staffs', StaffController::class);


    
    Route::apiResource('categories', CategoryController::class);
});




    // Route::get('/user', function (Request $request) {
    //     return $request->user();
    // });