<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()
            ->sequence(
                ['name' => 'Tyler Bauman', 'email' => 'tyler.bauman@cocktails.com'],
                ['name' => 'Allie Eusebi', 'email' => 'allie.eusebi@cocktails.com']
            )
            ->create();
    }
}
