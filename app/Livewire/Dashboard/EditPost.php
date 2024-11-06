<?php

namespace App\Livewire\Dashboard;

use App\Models\Post;
use Livewire\Component;

class EditPost extends Component
{
    // public UpdatePost $updateForm;
    public $post;

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function render()
    {
        return view('livewire.dashboard.edit-post', [
            'post' => $this->post,
        ]);
    }
}
