<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// Broadcast::channel('test-user', function() {
//     return true;
// });

Broadcast::channel('liked-user', function () {
    return true;
}, ['guards' => ['web']]);

Broadcast::channel('commentedUser', function () {
    return true;
}, ['guards' => ['web']]);
