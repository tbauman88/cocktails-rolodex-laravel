<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\User;
use Database\Helpers\Drinks;
use Illuminate\Database\Seeder;

class DrinkIngredientsSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedDrinks(User::firstOrFail());
    }

    public function seedDrinks(User $user): void
    {
        Drinks::entities()->each(function ($entity) use ($user) {
            $entity = (object)$entity;

            $drink = $user->drinks()->create(['name' => $entity->name]);

            collect($entity->ingredients)->each(function ($ingredient) use ($drink) {
                $ingredient = (object)$ingredient;
                $createdIngredient = Ingredient::firstOrCreate(['name' => $ingredient->name]);

                $drink->ingredients()->attach(
                    $createdIngredient->id,
                    array_filter([
                        'amount' => $ingredient->amount,
                        'amount_unit' => $ingredient->amount_unit ?? 0,
                        'brand' => $ingredient->brand ?? null,
                        'garnish' => $ingredient->garnish ?? false,
                        'required' => $ingredient->required ?? false
                    ])
                );
            });
        });
    }
}
