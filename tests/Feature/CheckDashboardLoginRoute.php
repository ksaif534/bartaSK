<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('Test logged in dashboard route', function () {
    //Arrange
    $user = User::factory()->create();
    //Act
    $response = $this->actingAs($user)->get(route('dashboard.index'));
    //Assert
    $response->assertStatus(200);
});
