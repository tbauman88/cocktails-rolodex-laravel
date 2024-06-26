<?php

namespace Database\Helpers;

use Illuminate\Support\Collection;

class Drinks
{
    public static array $COCKTAILS = [
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
                ["name" => "Bourbon", "amount" => "2", "amount_unit" => "oz"],
                ["name" => "Sweet Vermouth", "amount" => "1", "amount_unit" => "oz"],
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
                ["name" => "Bénédictine", "amount" => "0.5", "amount_unit" => "oz"],
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

    public static function entities(): Collection
    {
        return collect(self::$COCKTAILS);
    }
}
