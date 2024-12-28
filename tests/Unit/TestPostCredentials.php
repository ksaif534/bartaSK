<?php

use App\Models\Post;

test('check whether post creadentials are correct', function () {
    //Arrange
    $post = [
      'description' => 'Hi Guys, This is a test post body'  
    ];
    //Assert
    expect($post['description'])->toContain('Hi Guys');
});
