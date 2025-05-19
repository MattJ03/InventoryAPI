<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::Post('/register', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
