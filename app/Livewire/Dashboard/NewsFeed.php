<?php

namespace App\Livewire\Dashboard;

use Illuminate\Support\Facades\{DB};
use Livewire\{Component,WithPagination};
use App\Models\Post;

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
        // $posts = DB::table('posts')
        //     ->join('users', 'users.id', '=', 'posts.user_id')
        //     ->select('users.username', 'users.image', 'posts.*')
        //     ->orderBy('posts.id', 'asc')
        //     ->cursorPaginate($this->perPage);
        
        $posts = Post::with(['user:id,username,image','comments.user:id,username,image'])
            ->select('posts.*')
            ->orderBy('posts.id', 'asc')
            ->cursorPaginate($this->perPage);


        return view('livewire.dashboard.news-feed', [
            'posts' => $posts,
        ]);
    }
}
