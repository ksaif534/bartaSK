<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        return DB::table('posts')
            ->where('id', $id)
            ->update([
                'description' => $validated['description'],
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
    }
}
