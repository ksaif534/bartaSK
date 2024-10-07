<x-dashboard.layout :users="$users">
    <x-slot name="searchUser">
        @if (count($users) == 0)
            <article class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6">
                <!-- Content -->
                <div class="py-4 text-gray-700 font-normal">
                    <p>
                        <strong>Sorry, no users found</strong>
                    </p>
                </div>
            </article>
        @endif
        @foreach ($users as $user)
            <!-- Barta Card With Image -->
            <article
            class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6">
                <!-- Barta Card Top -->
                <header>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                        <!-- User Avatar -->
                        <div class="flex-shrink-0">
                            <img
                            class="h-10 w-10 rounded-full object-cover"
                            src="{{ !is_null($user->image) ? url('storage/'.$user->image) : 'https://picsum.photos/200/300'  }}"
                            alt="{{ $user->name }}" />
                        </div>
                        <!-- /User Avatar -->
            
                        <!-- User Info -->
                        <div class="text-gray-900 flex flex-col min-w-0 flex-1">
                            <a
                            href="https://github.com/alnahian2003"
                            class="hover:underline font-semibold line-clamp-1">
                            {{ $user->name }}
                            </a>
            
                            <a
                            href="https://twitter.com/alnahian2003"
                            class="hover:underline text-sm text-gray-500 line-clamp-1">
                            {{ '@'.$user->username }}
                            </a>
                        </div>
                        <!-- /User Info -->
                        </div>
            
                    </div>
                </header>
        
                <!-- Content -->
                <div class="py-4 text-gray-700 font-normal">
                    <img src="{{ url('storage/'.$user->image) }}" class="min-h-auto w-full rounded-lg object-cover max-h-64 md:max-h-72" alt="">
                    <p>
                        {{ $user->bio }}
                    </p>
                </div>
        
            </article>
            <!-- /Barta Card -->
        @endforeach
    </x-slot>
</x-dashboard.layout>