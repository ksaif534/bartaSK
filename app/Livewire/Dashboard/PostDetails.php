<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\{Post,Like};
use Illuminate\Support\Facades\{DB,Auth,Artisan};
use App\Events\UserLikesPost;
use App\Notifications\UserLikedPost;

class PostDetails extends Component
{
    public $post;
    
    public $notifications;

    public function mount(object $post)
    {
        $this->post = $post;
    }

    public function like(string $postId)
    {
        if (Auth::user()) {
            $checkExistingLike = Like::where('user_id',Auth::user()->id)->where('post_id',$postId)->latest()->first();

            if ($checkExistingLike) {
                $checkExistingLike->delete();

                DB::table('notifications')->where('notifiable_id',Auth::user()->id)->delete();

                $updatedPostLike = Post::where('id',$postId)->first()->decrement('like_count');

                return back()->with(['msg' => 'Post Already Liked. Unliked the Post', 'like_count' => $updatedPostLike]);
            }

            $updatedPostLike = Post::where('id',$postId)->first()->increment('like_count');

            $newLike = Like::create([
                'user_id'   => Auth::user()->id,
                'post_id'   => $postId
            ]);

            $message = Auth::user()->name . ' Liked your post';

            UserLikesPost::dispatch($message, Auth::user()->id, $postId);

            Artisan::call('queue:work',['--once' => true]);

            Auth::user()->notify(new UserLikedPost($postId));
            
            DB::table('notifications')->where('notifiable_id',Auth::user()->id)->update([
                'post_id'   => $postId
            ]);

            return back()->with(['msg' => 'Post Liked Successfully', 'can_change_fill' => true, 'post_id' => $postId, 'like_count' => $updatedPostLike]);
        }

        return back()->with(['msg' => 'Sorry, Could not Like Post']);
    }
    
    public function render()
    {
        $post = Post::where('id',$this->post->id)->first();
        
        return view('livewire.dashboard.post-details',[
            'post' => $post
        ]);
    }
}
