<?php

namespace App\Console\Commands;

use App\Models\Drink;
use App\Models\User;
use Illuminate\Console\Command;

class Tinker extends Command
{
    protected $signature = 'app:tinker';
    protected $description = 'Command description';

    public function handle(): int
    {
        $user = User::query()->first();

        // Suggested Cocktails feature
//         $user->suggestedCocktails()->pluck('name')->toArray();
         $user->recommendedCocktails()->pluck('name')->toArray();

        // Favourite Drinks feature
//         $drink = Drink::where('name', 'Millward Manhattan')->first();
//         $user->toggleDrink($drink);
//         dump($user->favouriteDrinks()->get()->toArray());

        return self::SUCCESS;
    }
}
