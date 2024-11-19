<div>
    <!-- News Feed -->
    <section id="newsfeed" class="space-y-6">
        @foreach ($posts as $post)
            <livewire:dashboard.feed-post :post="$post" wire:key="post-{{ request()->session()->has('post_id') ? request()->session()->get('post_id') : $post->id  }}" />
        @endforeach
        
        @if ($posts->hasMorePages())
            <div class="flex flex-col items-center">
                <button wire:click="loadMore" class="text-gray-900 hover:text-white border-2 border-gray-800 hover:bg-gray-900 focus:ring-2 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center hidden md:block">
                    Show More
                </button>
            </div>
        @endif
    </section>
</div>
