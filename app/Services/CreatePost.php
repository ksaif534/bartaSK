<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CreatePost
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Create a new Post
     */
    public function store($validatedData)
    {
        return DB::table('posts')->insert([
            'author' => auth()->user()->name,
            'user_id' => auth()->user()->id,
            'description' => $validatedData['description'],
            'created_at' => Carbon::now()->format('y-m-d'),
        ]);
    }
}
