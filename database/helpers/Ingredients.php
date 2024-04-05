<?php

namespace Database\Helpers;

use Illuminate\Support\Collection;

class Ingredients
{
    public static array $LIQUORS = [
        [
            "name" => "Bourbon",
            "brand" => "Woodford Reserve",
            "category" => "American Whiskey"
        ],
        [
            "name" => "Bourbon",
            "brand" => "Rabbit Hole Cavehill",
            "category" => "American Whiskey"
        ],
        [
            "name" => "Bourbon",
            "brand" => "Wild Turkey Rare Breed",
            "category" => "American Whiskey"
        ],
        [
            "name" => "Bourbon",
            "brand" => "Maker's Mark Cask Strength",
            "category" => "American Whiskey"
        ],
        [
            "name" => "Bourbon",
            "brand" => "Four Roses",
            "category" => "American Whiskey"
        ],
        [
            "name" => "Whiskey",
            "brand" => "Bushmills",
            "category" => "Irish Whiskey"
        ],
        [
            "name" => "Whiskey",
            "brand" => "Jameson Black Barrel",
            "category" => "Irish Whiskey"
        ],
        [
            "name" => "Whiskey",
            "brand" => "Tullamore Dew",
            "category" => "Irish Whiskey"
        ],
        [
            "name" => "Whiskey",
            "brand" => "Miyagikyo Single Malt",
            "category" => "Japanese Whiskey"
        ],
        [
            "name" => "Whiskey",
            "brand" => "Alberta Premium Cask Strength Rye 2023",
            "category" => "Canadian Whiskey"
        ],
        [
            "name" => "Tequila",
            "brand" => "Casamigos",
            "category" => "Blanco"
        ],
        [
            "name" => "Tequila",
            "brand" => "Espolon",
            "category" => "Blanco"
        ],
        [
            "name" => "Mezcal",
            "brand" => "Leyenda Tlacuache",
        ],
        [
            "name" => "Gin",
            "brand" => "Bombay Sapphire",
            "category" => "London Dry"
        ],
        [
            "name" => "Gin",
            "brand" => "Beefeater",
            "category" => "London Dry"
        ],
        [
            "name" => "Gin",
            "brand" => "The Botanist",
            "category" => "London Dry"
        ],
        [
            "name" => "Gin",
            "brand" => "Empress 1908",
            "category" => "London Dry"
        ],
        [
            "name" => "Gin",
            "brand" => "Aviation",
            "category" => "American"
        ],
        [
            "name" => "Gin",
            "brand" => "Cantarelle",
            "category" => "Canadian"
        ],
        [
            "name" => "Gin",
            "brand" => "Gray Jay",
            "category" => "Canadian"
        ],
        [
            "name" => "Gin",
            "brand" => "Collective Arts Rhubarb & Hibiscus",
            "category" => "Flavoured"
        ],
        [
            "name" => "Brandy",
            "brand" => "St Remy VSOP",
        ],
        [
            "name" => "Rum",
            "brand" => "Appleton Estate",
        ],
        [
            "name" => "Rum",
            "brand" => "Captain Morgan",
            "category" => "White Rum"
        ],
        [
            "name" => "Rum",
            "brand" => "Sailor Jerry",
            "category" => "Spiced Rum"
        ],
        [
            "name" => "Rum",
            "brand" => "Baron Samedi",
            "category" => "Spiced Rum"
        ],
        [
            "name" => "Rum",
            "brand" => "Malibu Coconut",
            "category" => "Flavoured"
        ],
        [
            "name" => "Vodka",
            "brand" => "Reyka",
        ],
        [
            "name" => "Vodka",
            "brand" => "Tito's",
        ],
        [
            "name" => "Vodka",
            "brand" => "Hound's Black",
        ],
        [
            "name" => "Dry Vermouth",
            "brand" => "Martini",
            "category" => "Liqueur"
        ],
        [
            "name" => "Sweet Vermouth",
            "brand" => "Cocchi",
            "category" => "Liqueur"
        ],
        [
            "name" => "Sweet Vermouth",
            "brand" => "Martini",
            "category" => "Liqueur"
        ],
        [
            "name" => "Lillet Blanc",
            "category" => "Liqueur"
        ],
        [
            "name" => "Cointreau",
            "category" => "Liqueur"
        ],
        [
            "name" => "Kahlúa",
            "category" => "Liqueur"
        ],
        [
            "name" => "Amaro Averna",
            "category" => "Liqueur"
        ],
        [
            "name" => "Amaro Montenegro",
            "category" => "Liqueur"
        ],
        [
            "name" => "Amaro Nonino",
            "category" => "Liqueur"
        ],
        [
            "name" => "Green Chartreuse",
            "category" => "Liqueur"
        ],
        [
            "name" => "Yellow Chartreuse",
            "category" => "Liqueur"
        ],
        [
            "name" => "Campari",
            "category" => "Liqueur"
        ],
        [
            "name" => "Aperol",
            "category" => "Liqueur"
        ],
        [
            "name" => "Luxardo Maraschino",
            "category" => "Liqueur"
        ],
        [
            "name" => "Fernet Branca",
            "category" => "Liqueur"
        ],
        [
            "name" => "Absinthe",
            "category" => "Liqueur"
        ],
        [
            "name" => "Bénédictine",
            "brand" => "Bénédictine & Brandy",
            "category" => "Liqueur"
        ],
        [
            "name" => "Amaretto",
            "brand" => "Disaronno",
            "category" => "Liqueur"
        ],
        [
            "name" => "Cassis",
            "brand" => "Labbe Francois",
            "category" => "Liqueur"
        ],
        [
            "name" => "Sherry",
            "brand" => "Lustau",
            "category" => "Liqueur"
        ]
    ];

    public static array $BITTERS = [
        [
            "name" => "Angostura Bitters",
            "category" => "Bitters"
        ],
        [
            "name" => "Orange Bitters",
            "category" => "Bitters"
        ],
        [
            "name" => "Peach Bitters",
            "category" => "Bitters"
        ],
        [
            "name" => "Black Walnut Bitters",
            "category" => "Bitters"
        ],
    ];

    public static array $SYRUPS = [
        [
            "name" => "Simple Syrup",
            "category" => "Syrup"
        ],
    ];

    public static function entities(): Collection
    {
        return collect(array_merge(self::$LIQUORS, self::$SYRUPS, self::$BITTERS));
    }
}
