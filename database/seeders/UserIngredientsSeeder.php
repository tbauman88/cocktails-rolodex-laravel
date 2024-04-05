<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\User;
use Database\Helpers\Ingredients;
use Illuminate\Database\Seeder;

class UserIngredientsSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrFail();

        Ingredients::entities()->each(function ($entity) use ($user) {
            $entity = (object)$entity;
            $ingredient = Ingredient::firstOrCreate(['name' => $entity->name]);

            $user->ingredients()->attach(
                $ingredient->id,
                array_filter([
                    'brand' => $entity?->brand ?? $ingredient->name,
                    'category' => $entity->category ?? null
                ])
            );
        });
    }
}
