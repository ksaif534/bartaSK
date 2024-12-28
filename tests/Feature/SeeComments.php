<?php

use App\Livewire\Dashboard\Comments;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\{User,Post,Comment};
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('see the comments of a post', function () {
    //Arrange
    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);
    $comment = Comment::factory()->create(['post_id' => $post->id,'user_id' => $user->id]);
    //Act + Assert
    Livewire::test(Comments::class, ['post' => $post])
        ->assertSee($comment->comment);
});
