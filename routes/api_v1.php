<?php

use App\Http\Controllers\Api\V1\EmployeeController;
use App\Http\Controllers\Api\V1\ZoneController;
use App\Http\Controllers\AuthController;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->apiResource('employees', EmployeeController::class);
Route::middleware('auth:sanctum')->apiResource('zones', ZoneController::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
