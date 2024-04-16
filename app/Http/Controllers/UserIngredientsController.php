<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserIngredientResource;
use App\Models\User;
use App\Models\UserIngredient;
use Illuminate\Http\JsonResponse;

class UserIngredientsController extends Controller
{
    public function index(string $id): JsonResponse
    {
        $user = User::findOrFail($id);
        $ingredients = UserIngredient::where('user_id', $user->id)->get();

        return response()->json(UserIngredientResource::collection($ingredients));
    }
}
