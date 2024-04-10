<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserDrinksController extends Controller
{
    public function index(Request $request, string $id): JsonResponse
    {
        $user = User::findOrFail($id);
        $type = $request->query('type');

        $drinks = match ($type) {
            'suggested' => $user->suggestedCocktails(),
            'recommended' => $user->recommendedCocktails(),
            default => $user->drinks,
        };

        return response()->json($drinks);
    }
}
