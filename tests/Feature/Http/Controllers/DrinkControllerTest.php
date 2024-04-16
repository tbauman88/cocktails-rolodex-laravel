<?php

use App\Models\Drink;
use App\Models\User;
use Illuminate\Http\JsonResponse;

test('it returns all drinks', function () {
    $existingDrinks = Drink::all();
    $drinks = Drink::factory(5)->user()->create();

    $expectedCount = $existingDrinks->count() + $drinks->count();

    $response = $this
        ->get(route('drinks.index'))
        ->assertStatus(JsonResponse::HTTP_OK);

    $this->assertCount($expectedCount, $response->json());
});

test('it returns a specific drink', function () {
    $user = User::factory()->create();
    $drink = Drink::factory()->for($user)->create();

    $this
        ->actingAs($user)
        ->get(route('drinks.show', ['drink' => $drink->getKey()]))
        ->assertStatus(JsonResponse::HTTP_OK)
        ->assertJsonFragment([
            'name' => $drink->name,
            'user' => $drink->user->name,
        ]);
});

test('it returns not implemented when trying to store a drink', function () {
    $drinkData = Drink::factory()->make()->toArray();

    $this
        ->post(route('drinks.store'), $drinkData)
        ->assertStatus(JsonResponse::HTTP_NOT_IMPLEMENTED);
})->skip('Not implemented');

test('it returns not implemented when trying to update a drink', function () {
    $drink = Drink::factory()->create();
    $drinkData = Drink::factory()->make()->toArray();

    $this
        ->put(route('drinks.update', ['drink' => $drink->getKey()]), $drinkData)
        ->assertStatus(JsonResponse::HTTP_NOT_IMPLEMENTED);
})->skip('Not implemented');

test('it deletes a drink', function () {
    $drink = Drink::factory()->user()->create();

    $this
        ->delete(route('drinks.destroy', ['drink' => $drink->getKey()]))
        ->assertStatus(JsonResponse::HTTP_NO_CONTENT);

    $this->assertSoftDeleted('drinks', ['id' => $drink->getKey()]);
});
