<?php

use App\Http\Controllers\DrinkController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', fn(Request $request) => $request->user())->middleware('auth:sanctum');

Route::resource('user.drinks', UserController::class)->only(['index', 'show']);
Route::resource('drinks', DrinkController::class)->only(['index', 'store', 'show']);
Route::resource('ingredients', IngredientController::class)->only('index');
