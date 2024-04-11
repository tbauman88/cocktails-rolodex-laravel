<?php

use App\Models\Drink;
use App\Models\Ingredient;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
});

test('it returns the drinks for an ingredient', function () {
    $ingredient = Ingredient::factory()->create(['name' => 'Gin (Tanqueray)']);
    $drinks = Drink::factory()->for($this->user)->count(3)->create();

    [$firstDrink, $secondDrink, $thirdDrink] = $drinks;

    $ingredient->drinks()->attach([
        ['drink_id' => $firstDrink->getKey(), 'amount' => 1, 'amount_unit' => 'oz'],
        ['drink_id' => $secondDrink->getKey(), 'amount' => 1, 'amount_unit' => 'oz'],
    ]);

    $actual = $ingredient->drinks();
    $drinkNames = $actual->pluck('name');

    expect($actual->get())->toHaveCount(2);
    expect($drinkNames)->not->toContain($thirdDrink->name);
});

