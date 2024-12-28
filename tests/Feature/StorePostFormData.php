<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('When logged in user submits post creation form', function () {
    //Arrange
    $user = User::factory()->create();

    $formData = [
        'author' => $user->name,
        'description' => 'This is a test post body',
        'picture' => null,
    ];
    //Act
    $response = $this->actingAs($user)->post(route('posts.store'), $formData);
    //Assert
    expect($response->status())->toBe(302);
});
