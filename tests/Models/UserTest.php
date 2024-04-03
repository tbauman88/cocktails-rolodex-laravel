<?php

use App\Models\Drink;
use App\Models\Ingredient;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

uses(TestCase::class);
uses(DatabaseTransactions::class);

const INGREDIENTS = [
    'Gin',
    'Bourbon',
    'Campari',
    'Sweet Vermouth',
];

beforeEach(function () {
    $this->user = User::factory()->create();
});

describe('favouriteDrinks', function () {
    test('it allows the user to add drinks from their favourites', function () {
        $drink = Drink::factory()->for($this->user)->create(['name' => 'Black Manhattan', 'save_count' => 0]);
        $this->user->toggleDrink($drink);

        $actual = $this->user->favouriteDrinks()->get();
        $actualName = $actual->pluck('name')->first();

        expect($actual)
            ->toHaveCount(1)
            ->and($actualName)->toEqual($drink->name);
    });

    test('it allows the user to remove drinks from their favourites', function () {
        $drink = Drink::factory()->for($this->user)->create(['name' => 'Black Manhattan', 'save_count' => 1]);
        $this->user->favouriteDrinks()->attach($drink->id);

        $this->user->toggleDrink($drink);

        $actual = $this->user->favouriteDrinks();

        expect($actual->count())->toBe(0);
    });
});

describe('suggestedCocktails', function () {
    test('it returns suggested cocktails when user has all ingredients', function () {
        attachUserIngredients($this->user);

        $actual = $this->user->suggestedCocktails();

        expect($actual)->toHaveCount(1);

    });
});

describe('recommendedCocktails', function () {
    test('it returns recommended cocktails when user has all required ingredients', function () {
        attachUserIngredients($this->user);

        $actual = $this->user->recommendedCocktails();
        expect($actual)->toHaveCount(1);
    });
});

function attachUserIngredients(User $user): void
{
    foreach (INGREDIENTS as $name) {
        $ingredient = Ingredient::where(['name' => $name])->first();
        $user->ingredients()->attach($ingredient->id);
    }
}
