<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserIngredientsController extends Controller
{
    public function index(string $id): JsonResponse
    {
        $user = User::findOrFail($id);

        return response()->json($user->ingredients);
    }
}
