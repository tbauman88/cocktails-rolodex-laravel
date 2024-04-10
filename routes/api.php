<?php

use App\Http\Controllers\DrinkController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDrinksController;
use App\Http\Controllers\UserIngredientsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', fn(Request $request) => $request->user())->middleware('auth:sanctum');

Route::resource('users', UserController::class);
Route::resource('drinks', DrinkController::class);
Route::resource('ingredients', IngredientController::class);

Route::get('users/{user}/drinks', [UserDrinksController::class, 'index'])->name('user.drinks.index');
Route::get('users/{user}/ingredients', [UserIngredientsController::class, 'index'])->name('user.ingredients.index');
