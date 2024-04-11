<?php

use App\Models\Ingredient;
use App\Models\User;
use Illuminate\Http\JsonResponse;

test('it returns all ingredients of a user', function () {
    $user = User::factory()->create();
    $ingredients = Ingredient::factory(3)->create();

    $user->ingredients()->attach($ingredients);

    $this
        ->get(route('user.ingredients.index', ['user' => $user->getKey()]))
        ->assertStatus(JsonResponse::HTTP_OK)
        ->assertJsonCount($ingredients->count());
});

test('it does not return ingredients attached to another user', function () {
    [$firstUser, $secondUser] = User::factory(2)->create();

    $ingredientsUser1 = Ingredient::factory(3)->create();
    $ingredientsUser2 = Ingredient::factory(2)->create();

    $firstUser->ingredients()->attach($ingredientsUser1);
    $secondUser->ingredients()->attach($ingredientsUser2);

    $response = $this
        ->get(route('user.ingredients.index', ['user' => $firstUser->getKey()]))
        ->assertStatus(JsonResponse::HTTP_OK)
        ->assertJsonCount($ingredientsUser1->count());

    $ingredientsUser1->each(function ($ingredient) use ($response) {
        $response->assertJsonFragment(['name' => $ingredient->name]);
    });

    $ingredientsUser2->each(function ($ingredient) use ($response) {
        $response->assertJsonMissing(['name' => $ingredient->name]);
    });
});
