<?php

use App\Models\Drink;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
});

test('it returns the ingredients for a drink', function () {
    $drink = Drink::factory()->for($this->user)->create(['name' => 'Black Manhattan']);

    $drink->ingredients()->attach([
        ['ingredient_id' => 1, 'amount' => 1, 'amount_unit' => 'oz'],
        ['ingredient_id' => 2, 'amount' => 1, 'amount_unit' => 'oz'],
    ]);

    $actual = $drink->ingredients();

    expect($actual->get())->toHaveCount(2);
});

test('it returns the users favourited drinks', function () {
    $drink = Drink::factory()->for($this->user)->create(['name' => 'Black Manhattan']);
    $this->user->toggleDrink($drink);

    $actual = $this->user->favouriteDrinks();

    $actualName = $actual->pluck('name')->first();

    expect($actual->get())
        ->toHaveCount(1)
        ->and($actualName)->toEqual($drink->name);
});
