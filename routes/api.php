<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// File and Folder routes
Route::middleware(['auth:sanctum'])->group(function () {
    // country routes
    Route::apiResource('country', CountryController::class);
});
