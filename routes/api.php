<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    
});

// register api
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);

// login api
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);

// logout api
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->middleware('auth:sanctum');

// country routes
Route::apiResource('country', CountryController::class);