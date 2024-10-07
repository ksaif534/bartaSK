<?php

namespace App\Services;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        if ($validatedData['picture']) {
            $fileName = $validatedData['picture']->getClientOriginalName();
            Storage::putFileAs('public', $validatedData['picture'], $fileName);

            return Post::create([
                'author' => auth()->user()->name,
                'user_id' => auth()->user()->id,
                'description' => $validatedData['description'],
                'picture' => $fileName,
            ]);
        }

        return DB::table('posts')->insert([
            'author' => auth()->user()->name,
            'user_id' => auth()->user()->id,
            'description' => $validatedData['description'],
            'created_at' => Carbon::now()->format('y-m-d'),
        ]);
    }
}
