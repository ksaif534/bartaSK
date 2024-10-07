<?php

namespace App\Services;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UpdatePost
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}

    /**
     * Update Post
     */
    public function update(string $id, array $validated): bool
    {
        if ($validated['picture']) {
            $fileName = $validated['picture']->getClientOriginalName();
            Storage::putFileAs('public', $validated['picture'], $fileName);

            return Post::where('id', $id)->update([
                'description' => $validated['description'],
                'picture' => $fileName,
            ]);
        }

        return DB::table('posts')
            ->where('id', $id)
            ->update([
                'description' => $validated['description'],
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
    }
}
