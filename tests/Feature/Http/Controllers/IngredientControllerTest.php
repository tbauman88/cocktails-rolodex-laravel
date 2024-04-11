<?php

use App\Models\Ingredient;
use Illuminate\Http\JsonResponse;

test('it returns all ingredients', function () {
    $existingIngredients = Ingredient::all();
    $ingredients = Ingredient::factory(5)->create();

    $expectedCount = $existingIngredients->count() + $ingredients->count();

    $this
        ->get(route('ingredients.index'))
        ->assertStatus(JsonResponse::HTTP_OK)
        ->assertJsonCount($expectedCount);
});

test('it returns a specific ingredient', function () {
    $ingredient = Ingredient::factory()->create();

    $this
        ->get(route('ingredients.show', ['ingredient' => $ingredient->getKey()]))
        ->assertStatus(JsonResponse::HTTP_OK)
        ->assertJsonFragment(['name' => $ingredient->name]);
});

test('it stores an ingredient', function () {
    $ingredientData = Ingredient::factory()->make();

    $this
        ->post(route('ingredients.store'), $ingredientData->toArray())
        ->assertStatus(JsonResponse::HTTP_CREATED)
        ->assertJsonFragment(['name' => $ingredientData->name]);
});

test('it updates an ingredient', function () {
    $ingredient = Ingredient::factory()->create();
    $ingredientData = Ingredient::factory()->make();

    $this
        ->put(route('ingredients.update', ['ingredient' => $ingredient->getKey()]), $ingredientData->toArray())
        ->assertStatus(JsonResponse::HTTP_OK)
        ->assertJsonFragment(['name' => $ingredientData->name]);
});
