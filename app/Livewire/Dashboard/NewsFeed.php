<?php

namespace App\Livewire\Dashboard;

use Illuminate\Support\Facades\DB;
// use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class NewsFeed extends Component
{
    use WithPagination;

    public $perPage = 10;

    public $currentPost;

    public function loadMore()
    {
        $this->perPage = $this->perPage + 10;
    }

    public function render()
    {
        $posts = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->select('users.username', 'users.image', 'posts.*')
            ->orderBy('posts.id', 'asc')
            ->cursorPaginate($this->perPage);

        return view('livewire.dashboard.news-feed', [
            'posts' => $posts,
        ]);
    }
}
