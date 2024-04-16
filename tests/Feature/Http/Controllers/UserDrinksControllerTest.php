<?php

use App\Models\Ingredient;
use App\Models\User;
use App\Models\Drink;
use App\Models\UserIngredient;
use Illuminate\Http\JsonResponse;

test('it returns user drinks', function () {
    $user = User::factory()->create();

    $drinks = Drink::factory(5)->for($user)->create();
    Drink::factory(10)->user()->create();

    $response = $this
        ->actingAs($user)
        ->get(route('user.drinks.index', ['user' => $user->getKey()]))
        ->assertStatus(JsonResponse::HTTP_OK);

    $this->assertCount($drinks->count(), $response->json());
});

test('it returns suggested drinks for a user', function () {
    $user = User::factory()->create();

    $ingredients = Ingredient::factory(3)->create();

    $ingredients->each(function ($ingredient) use ($user) {
        UserIngredient::factory()->create([
            'user_id' => $user->getKey(),
            'ingredient_id' => $ingredient->getKey(),
        ]);
    });

    $drinks = Drink::factory(3)->sequence(
        ['user_id' => $user->getKey()],
        ['user_id' => User::factory()->create()],
        ['user_id' => User::factory()->create()]
    )->create();

    $drinks->each(function ($drink, $index) use ($ingredients) {
        $userIngredients = $index === 0
            ? $ingredients
            : Ingredient::factory(3)->create();

        foreach ($userIngredients as $ingredient) {
            $drink->ingredients()->attach($ingredient->getKey(), [
                'amount' => rand(1, 3),
                'amount_unit' => 'oz'
            ]);
        }
    });

    $response = $this
        ->actingAs($user)
        ->get(route('user.drinks.index', ['user' => $user->getKey(), 'type' => 'suggested']))
        ->assertStatus(JsonResponse::HTTP_OK)
        ->assertJsonFragment([
            'name' => $drinks[0]->name
        ]);

    $this->assertCount(1, $response->json());
});

test('it returns recommended drinks for a user', function () {
    $user = User::factory()->create();

    $drinks = Drink::all();
    $randomDrink = $drinks->random();
    $recommendedDrink = $drinks->where('id', '!=', $randomDrink->id)->random();

    $firstIngredients = $randomDrink->ingredients()->get();
    $secondIngredients = $recommendedDrink->ingredients()->get()->first();

    $userIngredients = collect([...$firstIngredients, $secondIngredients]);

    $userIngredients->each(function ($ingredient) use ($user) {
        UserIngredient::factory()->create([
            'user_id' => $user->getKey(),
            'ingredient_id' => $ingredient->getKey(),
        ]);
    });

    $this
        ->actingAs($user)
        ->get(route('user.drinks.index', ['user' => $user->getKey(), 'type' => 'recommended']))
        ->assertStatus(JsonResponse::HTTP_OK)
        ->assertJsonFragment(['name' => $recommendedDrink->name])
        ->assertJsonMissing(['name' => $randomDrink->name]);
});
