<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class SearchUser
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function search(array $validated): Collection
    {
        if ($validated['search']) {
            return User::where('id', auth()->user()->id)
                ->where('username', 'like', '%'.$validated['search'].'%')
                ->orWhere('email', 'like', '%'.$validated['search'].'%')
                ->orWhere('name', 'like', '%'.$validated['search'].'%')
                ->get();
        }
    }
}
