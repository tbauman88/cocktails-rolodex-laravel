<?php

namespace App\Http\Controllers;

use App\Http\Resources\IngredientResource;
use App\Models\Ingredient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $searchTerm = $request->input('search');

        $ingredients = Ingredient::query()
            ->where('name', 'LIKE', "%{$searchTerm}%")
            ->get();

        IngredientResource::$includeDrinks = $request->boolean('includeDrinks', true);

        return response()->json(IngredientResource::collection($ingredients));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request): JsonResponse
    {
        $ingredient = Ingredient::create(['name' => $request->input('name')]);
        $ingredient->save();

        return response()->json($ingredient, JsonResponse::HTTP_CREATED);
    }

    public function show(string $id): JsonResponse
    {
        return response()->json(Ingredient::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $ingredient = Ingredient::findOrFail($id);
        $ingredient->update(['name' => $request->input('name')]);

        return response()->json($ingredient);
    }

    public function destroy(string $id)
    {
        //
    }
}
