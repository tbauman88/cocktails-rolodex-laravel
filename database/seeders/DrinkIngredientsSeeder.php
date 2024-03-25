<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\User;
use Illuminate\Database\Seeder;

class DrinkIngredientsSeeder extends Seeder
{
    public const DRINKS = [
        [
            "name" => "Old Fashioned",
            "ingredients" => [
                ["name" => "Bourbon", "amount" => "1.5", "amount_unit" => "oz"],
                ["name" => "Simple Syrup", "amount" => "0.5", "amount_unit" => "oz"],
                ["name" => "Angostura Bitters", "amount" => "2", "amount_unit" => "dashes"]
            ]
        ],
        [
            "name" => "Martini",
            "ingredients" => [
                ["name" => "Gin", "amount" => "1", "amount_unit" => "oz"],
                ["name" => "Dry Vermouth", "amount" => "1", "amount_unit" => "oz"],
                ["name" => "Orange Bitters", "amount" => "1", "amount_unit" => "dash"]
            ]
        ],
        [
            "name" => "Manhattan",
            "ingredients" => [
                ["name" => "Bourbon", "amount" => "2", "amount_unit" => "oz", "required" => true],
                ["name" => "Sweet Vermouth", "amount" => "1", "amount_unit" => "oz", "required" => true],
                ["name" => "Angostura Bitters", "amount" => "2", "amount_unit" => "dashes"],
                ["name" => "Maraschino cherry", "amount" => "1", "garnish" => true]
            ]
        ],
        [
            "name" => "Negroni",
            "ingredients" => [
                ["name" => "Gin", "amount" => "1", "amount_unit" => "oz"],
                ["name" => "Campari", "amount" => "1", "amount_unit" => "oz"],
                ["name" => "Sweet Vermouth", "amount" => "1", "amount_unit" => "oz"]
            ]
        ],
        [
            "name" => "Espresso Martini",
            "ingredients" => [
                ["name" => "Vodka", "amount" => "2", "amount_amount_unit" => "oz"],
                ["name" => "Kahlúa", "amount" => "0.5", "amount_amount_unit" => "oz"],
                ["name" => "Espresso", "amount" => "1", "amount_amount_unit" => "oz"],
                ["name" => "Simple Syrup", "amount" => "0.5", "amount_amount_unit" => "oz"]
            ]
        ],
        [
            "name" => "Millward Manhattan",
            "ingredients" => [
                [
                    "name" => "Bourbon",
                    "amount" => "2",
                    "amount_unit" => "oz",
                    "brand" => "Woodford Reserve"
                ],
                [
                    "name" => "Sweet Vermouth",
                    "amount" => "0.5",
                    "amount_unit" => "oz",
                    "brand" => "Dolin Rouge"
                ],
                ["name" => "Cassis", "amount" => "0.5", "amount_unit" => "oz"],
                ["name" => "Simple Syrup", "amount" => "0.5", "amount_amount_unit" => "oz"],
                ["name" => "Peach Bitters", "amount" => "2", "amount_unit" => "dashes"],
                ["name" => "Maraschino cherry", "amount" => "1", "garnish" => true]
            ]
        ],
        [
            "name" => "Fernet Is My Safe Word",
            "notes" => "Fernet Blanc spray on glass, garnished with a lemon",
            "ingredients" => [
                ["name" => "Amaro Averna", "amount" => "0.5", "amount_unit" => "oz"],
                ["name" => "Bourbon", "amount" => "2", "amount_unit" => "oz"],
                ["name" => "Benedictine", "amount" => "0.5", "amount_unit" => "oz"],
                ["name" => "Black Walnut Bitters", "amount" => "2", "amount_unit" => "dashes"]
            ]
        ],
        [
            'name' => 'Adonis',
            'ingredients' => [
                ['name' => 'Sweet Vermouth', 'amount' => '2', 'amount_unit' => 'oz'],
                ['name' => 'Sherry', 'amount' => '1', 'amount_unit' => 'oz'],
                ['name' => 'Orange bitters', 'amount' => '2', 'amount_unit' => 'dashes']
            ]
        ]
    ];

    public function run(): void
    {
        $this->seedDrinks(User::firstOrFail());
    }

    public function seedDrinks(User $user): void
    {
        collect(self::DRINKS)->each(function ($drink) use ($user) {
            $drink = (object)$drink;

            $createdDrink = $user->drinks()->create(['name' => $drink->name]);

            collect($drink->ingredients)->each(function ($ingredient) use ($createdDrink) {
                $ingredient = (object)$ingredient;
                $createdIngredient = Ingredient::firstOrCreate(['name' => $ingredient->name]);

                $filter = array_filter([
                    'amount' => $ingredient->amount,
                    'amount_unit' => $ingredient->amount_unit ?? 0,
                    'brand' => $ingredient->brand ?? null,
                    'garnish' => $ingredient->garnish ?? false,
                    'required' => $ingredient->required ?? false
                ]);

                $createdDrink->ingredients()->attach(
                    $createdIngredient->id,
                    $filter
                );
            });
        });
    }
}
