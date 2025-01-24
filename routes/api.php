<?php

use App\Http\Controllers\Api\AuthController;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'lovgin']);
Route::post('/register', [AuthController::class, 'register']);
Route::middleware('auth:sanctum')->post('/login', [AuthController::class, 'logout']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
