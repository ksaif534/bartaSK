<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('loads the post creation form page', function () {
    //Arrange
    $user = User::factory()->create();
    //Act
    $response = $this->actingAs($user)->get(route('posts.create'));
    //Assert
    expect($response->status())->toBe(200);
});
