<?php

namespace App\Livewire\Dashboard;

use App\Models\Post;
use Livewire\Component;

class DeletePost extends Component
{
    public $post;

    public function delete()
    {
        $destroyBool = Post::where('id', $this->post->id)
            ->delete();

        if ($destroyBool) {
            return back()->with(['msg' => 'Post Deleted Successfully']);
        }

        return back()->with(['msg' => 'Sorry, Could not Delete Post']);
    }

    public function render()
    {
        return view('livewire.dashboard.delete-post', [
            'post' => $this->post,
        ]);
    }
}
