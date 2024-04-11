<?php

use App\Models\User;
use App\Models\Drink;
use Illuminate\Http\JsonResponse;

test('it returns user drinks', function () {
    $user = User::factory()->create();

    $drinks = Drink::factory(5)->for($user)->create();
    Drink::factory(10)->user()->create();

    $response = $this
        ->actingAs($user)
        ->get(route('user.drinks.index', ['user' => $user->getKey()]))
        ->assertStatus(JsonResponse::HTTP_OK);

    $this->assertCount($drinks->count(), $response->json());
});
