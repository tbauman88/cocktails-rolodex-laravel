<?php

namespace Database\Seeders;

use App\Models\Drink;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserDrinksSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::query()->first();

        $user->toggleDrink(Drink::where('name', 'Millward Manhattan')->first());
        $user->toggleDrink(Drink::where('name', 'Negroni')->first());
    }
}
