<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\{User};

uses(RefreshDatabase::class);

test('update user profile', function () {
    //Arrange
    $user = User::factory()->create();
    
    $updateData = [
        'name'      => 'John Doe',
        'username'  => 'johnD',
        'email'     => '4b5gj@example.com',
        'password'  => 'password',
        'bio'       => 'This is a bio'  
    ];
    //Act
    $response = $this->actingAs($user)->put(route('profiles.update',$user->id), $updateData);
    //Assert
    $response->assertStatus(302);
});
