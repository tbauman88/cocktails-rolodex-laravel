<?php

use App\Models\User;
use Illuminate\Http\JsonResponse;

test('it returns all users', function () {
    $existingUsers = User::all();
    $users = User::factory(5)->create();
    $expectedCount = $existingUsers->count() + $users->count();

    $response = $this->get(route('users.index'));

    $response->assertStatus(JsonResponse::HTTP_OK);
    $this->assertCount($expectedCount, $response->json());
});

test('it returns a specific user', function () {
    $user = User::factory()->create();

    $this
        ->get(route('users.show', ['user' => $user->getKey()]))
        ->assertStatus(JsonResponse::HTTP_OK)
        ->assertJson($user->toArray());
});

test('it returns not implemented when trying to store a user', function () {
    $userData = User::factory()->make()->toArray();

    $this
        ->post(route('users.store'), $userData)
        ->assertStatus(JsonResponse::HTTP_NOT_IMPLEMENTED);
})->skip('Not implemented');

test('it returns not implemented when trying to update a user', function () {
    $user = User::factory()->create();
    $userData = User::factory()->make()->toArray();

    $this
        ->put(route('users.update', ['user' => $user->getKey()]), $userData)
        ->assertStatus(JsonResponse::HTTP_NOT_IMPLEMENTED);
})->skip('Not implemented');

test('it deletes a user', function () {
    $user = User::factory()->create();

    $this
        ->delete(route('users.destroy', ['user' => $user->getKey()]))
        ->assertStatus(JsonResponse::HTTP_NO_CONTENT);

    $this->assertDatabaseMissing('users', ['id' => $user->getKey()]);
});
