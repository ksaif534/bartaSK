<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Events\UserLikesPost;
use App\Models\{Like,Post};
use App\Notifications\UserLikedPost;
use Illuminate\Support\Facades\{DB,Auth,Artisan};

class FeedPost extends Component
{
    public $post;

    public function like(string $postId)
    {
        $authUser = Auth::user();

        if ($authUser) {
            $checkExistingLike = Like::where('user_id',$authUser->id)->where('post_id',$postId)->latest()->first();

            $postToUpdate = Post::where('id',$postId)->first();

            if ($checkExistingLike) {
                $checkExistingLike->delete();

                DB::table('notifications')->where('notifiable_id',$authUser->id)->delete();

                $postToUpdate->decrement('like_count');

                $updatedPostLike = $postToUpdate->like_count;

                return back()->with(['msg' => 'Post Already Liked. Unliked the Post', 'can_change_fill' => false, 'post_id' => $postId, 'like_count' => $updatedPostLike]);
            }

            $postToUpdate->increment('like_count');

            $updatedPostLike = $postToUpdate->like_count;

            $newLike = Like::create([
                'user_id'   => $authUser->id,
                'post_id'   => $postId
            ]);

            $message = $authUser->name . ' Liked your post';

            UserLikesPost::dispatch($message, $authUser->id, $postId);

            Artisan::call('queue:work',['--once' => true]);

            $postAuthor = Post::where('id',$postId)->first()->user()->first();

            $postAuthor->notify(new UserLikedPost($postId));
            
            DB::table('notifications')->where('notifiable_id',$postAuthor->id)->update([
                'post_id'   => $postId
            ]);

            return back()->with(['msg' => 'Post Liked Successfully', 'can_change_fill' => true, 'post_id' => $postId, 'like_count' => $updatedPostLike]);
        }

        return back()->with(['msg' => 'Sorry, Could not Like Post']);
    }

    public function render()
    {
        return view('livewire.dashboard.feed-post');
    }
}
