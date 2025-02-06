<?php

use App\Http\Controllers\Api\V1\EmployeeController;
use App\Http\Controllers\Api\V1\InterimController;
use App\Http\Controllers\Api\V1\ProjectController;
use App\Http\Controllers\Api\V1\WorkerController;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->apiResource('employees', EmployeeController::class);

Route::middleware('auth:sanctum')->apiResource('interims', InterimController::class);

Route::middleware('auth:sanctum')->apiResource('workers', WorkerController::class);

Route::middleware('auth:sanctum')->apiResource('projects', ProjectController::class);