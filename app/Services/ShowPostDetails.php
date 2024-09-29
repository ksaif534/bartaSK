<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class ShowPostDetails
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the specific post details
     */
    public function show(string $id)
    {
        return DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->select('users.username', 'users.email', 'users.image', 'posts.*')
            ->where('posts.id', $id)
            ->first();
    }
}
