<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Stock;
use App\Models\User;
use App\Http\Controllers\StockController;
use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
Route::get('/index', [StockController::class, 'index']);
Route::post('/create', [StockController::class, 'create']);
Route::get('/stock/{id}', [StockController::class, 'show']);
Route::put('/stock/update/{id}', [StockController::class, 'update']);
Route::delete('/stock/delete/{id}', [StockController::class, 'delete']);

Route::post('/logout', [AuthController::class, 'logout']);
});

