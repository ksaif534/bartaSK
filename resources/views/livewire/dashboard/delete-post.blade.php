<div>
    @if (request()->session()->has('msg'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            <span class="font-medium">{{ session('msg') }}</span> 
        </div>
    @endif
    <form 
    {{-- action="{{ route('posts.destroy',$post->id) }}"  --}}
    {{-- method="POST"  --}}
    wire:submit="delete"
    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
        {{-- @method('DELETE')
        @csrf --}}
        <button type="submit" role="menuitem" tabindex="-1" id="user-menu-item-2">
            Delete
        </button>
    </form>
</div>
