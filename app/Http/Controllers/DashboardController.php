<?php

namespace App\Http\Controllers;

use App\Http\Requests\Dashboard\SearchUserRequest;
use App\Http\Requests\Dashboard\StoreOrUpdatePostRequest;
use App\Services\CreatePost;
use App\Services\FetchNewsFeed;
use App\Services\SearchUser;
use App\Services\ShowPostDetails;
use App\Services\UpdatePost;
use Illuminate\Support\Facades\{DB,Auth};

class DashboardController
{
    /**
     * Display a listing of the resource.
     */
    public function index(FetchNewsFeed $newsFeed)
    {
        // $posts = $newsFeed->posts();

        $notifications = DB::table('notifications')->whereIn('post_id', Auth::user()->posts()->pluck('id'))->whereNull('read_at')->get();

        return view('livewire.dashboard.index',compact('notifications'));
        // return view('dashboard.index', compact('posts'));
    }

    /**
     * Create Post Forms
     */
    public function create()
    {
        return view('dashboard.create-post');
    }

    /**
     * Search Post
     */
    public function search(SearchUserRequest $request, SearchUser $user)
    {
        $validated = $request->validated();
        $users = $user->search($validated);

        return view('dashboard.search-user', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrUpdatePostRequest $request, CreatePost $post)
    {
        $validated = $request->validated();
        if (auth()->user()) {
            $newPost = $post->store($validated);

            return back()->with(['msg' => 'The Post Has been Successfully Created']);
        }

        return back()->with(['msg' => 'Sorry the Post Has not been created']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, ShowPostDetails $postDetails)
    {
        $post = $postDetails->show($id);

        // return view('livewire.dashboard.post-details',compact('post'));

        return view('dashboard.post-details', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = DB::table('posts')->where('id', $id)->first();

        return view('dashboard.edit-post', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreOrUpdatePostRequest $request, string $id, UpdatePost $updatePost)
    {
        $validated = $request->validated();
        $updateBool = $updatePost->update($id, $validated);
        if ($updateBool) {
            return back()->with(['msg' => 'Post Updated Successfully']);
        }

        return back()->with(['msg' => 'Sorry, Post Not Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $destroyBool = DB::table('posts')
            ->where('id', $id)
            ->delete();
        if ($destroyBool) {
            return back()->with(['msg' => 'Post Deleted Successfully']);
        }

        return back()->with(['msg' => 'Sorry, Could not Delete Post']);
    }
}
