<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class FetchNewsFeed
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Fetch all Posts for News Feed
     */
    public function posts()
    {
        return DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->select('users.username', 'users.image', 'posts.*')
            ->get();
    }
}
