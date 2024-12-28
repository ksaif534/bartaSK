<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\{User};

uses(RefreshDatabase::class);

test('see the user profile', function () {
    //Arrange
    $user = User::factory()->create();
    //Act
    $response = $this->actingAs($user)->get(route('profiles.show',$user->id));
    //Assert
    $response->assertStatus(200);
});
