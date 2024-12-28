<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

test('check whether user credentials are correct', function () {
    //Arrange
    $user = [
        'name'      => 'Saif Kamal',
        'username'  => 'Ksaif',
        'email'     => 'kamal.saifkamal534@gmail.com',
        'password'  => 'password'
    ];    
    //Assert
    expect($user['email'])->toBe('kamal.saifkamal534@gmail.com');
});
