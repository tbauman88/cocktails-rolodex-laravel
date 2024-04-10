<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDrinkRequest;
use App\Http\Resources\DrinkResource;
use App\Models\Drink;
use App\Models\Ingredient;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DrinkController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(DrinkResource::collection(Drink::all()));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(StoreDrinkRequest $request): JsonResponse
    {
        $request->validated();

        $drink = Drink::create([
            'name' => $request->input('name'),
            'notes' => $request->input('notes'),
            'user_id' => $request->input('user'),
            'published' => $request->input('published') ?: false,
        ]);

        $drink->save();

        foreach ($request->input('ingredients') as $item) {
            $item = (object)$item;
            $ingredient = Ingredient::firstOrCreate(["name" => $item->name]);

            $drink->ingredients()->attach($ingredient->id, [
                "amount" => $item->amount,
                'amount_unit' => $ingredient?->amount_unit,
                'brand' => $ingredient?->brand,
                'garnish' => $ingredient?->garnish,
            ]);
        }

        return response()->json(DrinkResource::make($drink), JsonResponse::HTTP_CREATED);
    }

    public function show(string $id): JsonResponse
    {
        return response()->json(DrinkResource::make(Drink::findOrFail($id)));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    public function update(string $id): JsonResponse
    {
        return response()->json(['message' => 'Not implemented'], JsonResponse::HTTP_NOT_IMPLEMENTED);
    }

    public function destroy(string $id): JsonResponse
    {
        $drink = Drink::findOrFail($id);
        $drink->delete();

        return response()->json(null, JsonResponse::HTTP_NO_CONTENT);
    }
}
