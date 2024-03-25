<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserIngredientsSeeder extends Seeder
{
    const INGREDIENTS = [
        'Gin',
        'Bourbon',
        'Campari',
        'Sweet Vermouth',
        'Vodka',
    ];

    public function run(): void
    {
        $user = User::firstOrFail();

        foreach (self::INGREDIENTS as $name) {
            if (!($ingredient = Ingredient::where('name', $name)->first())) {
                return;
            }

            $user->ingredients()->attach($ingredient->id);

            if ($name === 'Vodka') {
                $user->ingredients()->detach($ingredient->id);
            }
        }
    }
}
