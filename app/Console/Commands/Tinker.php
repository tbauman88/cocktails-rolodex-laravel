<?php

namespace App\Console\Commands;

use App\Models\Drink;
use App\Models\User;
use Illuminate\Console\Command;

class Tinker extends Command
{
    protected $signature = 'app:tinker';
    protected $description = 'Command description';

    // Look into laravel prompts to make this more interactive and user-friendly for now.
    public function handle(): int
    {
        $user = User::query()->first();

        $user->suggestedCocktails()->pluck('name')->toArray();
        $user->recommendedCocktails()->pluck('name')->toArray();

        return self::SUCCESS;
    }
}
