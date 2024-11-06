<?php

namespace App\Livewire\Dashboard;

use App\Models\Post;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdatePost extends Component
{
    use WithFileUploads;

    public $post;

    #[Validate('required|max:2047')]
    public $description;

    #[Validate('required|image:jpg,jpeg,png,bmp')]
    public $picture;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->description = $post->description;
        $this->picture = $post->picture;
    }

    public function update()
    {
        $validated = $this->validate();

        $fileName = $this->picture->getClientOriginalName();
        $this->picture->store('public');

        if ($this->picture) {
            Post::where('id', $this->post->id)->update([
                'description' => $this->description,
                'picture' => $fileName,
            ]);

            return back()->with(['msg' => 'Post Successfully Updated']);
        }
        Post::where('id', $this->post->id)->update([
            'description' => $this->description,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        return back()->with(['msg' => 'Post Successfully Updated']);
    }

    public function render()
    {
        return view('livewire.dashboard.update-post', [
            'post' => $this->post,
        ]);
    }
}
