<?php

namespace App\Livewire\Dashboard;

use App\Mail\SomeoneCommentedOnPost;
use Illuminate\Support\Facades\{Auth,Mail,Artisan,DB};
use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\{Comment,Post,User};
use App\Events\SomeoneCommentsOnPost;
use App\Notifications\SomeoneCommentedOnPost as InAppCommentNotification;

class CreateComment extends Component
{
    public $post;

    #[Validate('required|max:2047')]
    public $comment;

    public function create()
    {
        $validated = $this->validate();
        
        if (Auth::user()) {
            Comment::create([
                'user_id'   => Auth::user()->id,
                'post_id'   => $this->post->id,
                'comment'   => $validated['comment']
            ]);

            $post       = Post::where('id',$this->post->id)->first();
            $postAuthor = $post->user()->first();

            Mail::to($postAuthor->email)->send(new SomeoneCommentedOnPost(User::find(Auth::user()->id), $postAuthor));

            $message = Auth::user()->name . ' Commented on Your Post';

            SomeoneCommentsOnPost::dispatch($postAuthor->name, Auth::user()->name, $message);

            Artisan::call('queue:work',['--once' => true]);

            $postAuthor->notify(new InAppCommentNotification(Auth::user()->name));

            DB::table('notifications')->where('notifiable_id', $postAuthor->id)->update([
                'post_id'   => $post->id
            ]);

            return back()->with(['msg' => 'Comment Created Successfully']);
        }

        return back()->with(['msg' => 'Sorry, Could not create comment, user not authenticated']);
    }

    public function render()
    {
        return view('livewire.dashboard.create-comment');
    }
}