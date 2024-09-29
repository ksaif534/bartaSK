<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Barta</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- AlpineJS CDN -->
    <script
      defer
      src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link
      rel="preconnect"
      href="https://fonts.googleapis.com" />
    <link
      rel="preconnect"
      href="https://fonts.gstatic.com"
      crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
      rel="stylesheet" />

    <style>
      * {
        font-family: 'Inter', sans-serif;
      }
    </style>
</head>
<body>
    <!-- Navigation -->
    <x-dashboard.navbar>
        <nav
            x-data="{ mobileMenuOpen: false, userMenuOpen: false }"
            class="bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 justify-between">
                    <div class="flex">
                        <div class="flex flex-shrink-0 items-center">
                        <a href="{{ route('dashboard.index') }}">
                            <h2 class="font-bold text-2xl">Barta</h2>
                        </a>
                        </div>
                        <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <!-- Current: "border-gray-800 text-gray-900 font-semibold", Default: "border-transparent text-gray-600 hover:border-gray-300 hover:text-gray-800" -->
                        <a
                            href="#"
                            class="inline-flex items-center border-b-2 border-gray-800 px-1 pt-1 text-sm font-semibold text-gray-900"
                            >Discover</a
                        >
                        <a
                            href="#"
                            class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-gray-600 hover:border-gray-300 hover:text-gray-800"
                            >For you</a
                        >
                        <a
                            href="#"
                            class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-gray-600 hover:border-gray-300 hover:text-gray-800"
                            >People</a
                        >
                        </div>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex gap-2 sm:items-center">
                        <!-- This Button Should Be Hidden on Mobile Devices -->
                        <a
                            href="{{ route('posts.create') }}"
                            role="button"
                            class="text-gray-900 hover:text-white border-2 border-gray-800 hover:bg-gray-900 focus:ring-2 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center hidden md:block">
                            Create Post
                        </a>

                        <button
                        type="button"
                        class="rounded-full bg-white p-2 text-gray-800 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                        <span class="sr-only">View notifications</span>
                        <!-- Heroicon name: outline/bell -->
                        <svg
                            class="h-6 w-6"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            aria-hidden="true">
                            <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                        </svg>
                        </button>

                        <button
                        type="button"
                        class="rounded-full bg-white p-2 text-gray-800 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                        <span class="sr-only">Messages</span>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-6 h-6">
                            <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                        </svg>
                        </button>

                        <!-- Profile dropdown -->
                        <div
                        class="relative ml-3"
                        x-data="{ open: false }">
                        <div>
                            <button
                            @click="open = !open"
                            type="button"
                            class="flex rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
                            id="user-menu-button"
                            aria-expanded="false"
                            aria-haspopup="true">
                            <span class="sr-only">Open user menu</span>
                            <img
                                class="h-8 w-8 rounded-full"
                                src="{{ !is_null(auth()->user()->image) ? url('storage/'.auth()->user()->image) : 'https://picsum.photos/200/300'  }}"
                                alt="Placeholder Image" />
                            </button>
                        </div>

                        <!-- Dropdown menu -->
                        <div
                            x-show="open"
                            @click.away="open = false"
                            class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu"
                            aria-orientation="vertical"
                            aria-labelledby="user-menu-button"
                            tabindex="-1">
                            <a
                            href="{{ route('profiles.show',auth()->user()->id) }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                            role="menuitem"
                            tabindex="-1"
                            id="user-menu-item-0"
                            >Your Profile</a
                            >
                            <a
                            href="{{ route('profiles.edit',auth()->user()->id) }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                            role="menuitem"
                            tabindex="-1"
                            id="user-menu-item-1"
                            >Edit Profile</a
                            >
                            <form action="{{ route('auth.logout') }}" method="POST" class="block px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800">
                                @csrf
                                <button type="submit" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                    Sign out
                                </button>
                            </form>
                        </div>
                        </div>
                    </div>
                    <div class="-mr-2 flex items-center sm:hidden">
                        <!-- Mobile menu button -->
                        <button
                        @click="mobileMenuOpen = !mobileMenuOpen"
                        type="button"
                        class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-gray-500"
                        aria-controls="mobile-menu"
                        aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <!-- Icon when menu is closed -->
                        <svg
                            x-show="!mobileMenuOpen"
                            class="block h-6 w-6"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            aria-hidden="true">
                            <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>

                        <!-- Icon when menu is open -->
                        <svg
                            x-show="mobileMenuOpen"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-6 h-6">
                            <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu, show/hide based on menu state. -->
            <div
                x-show="mobileMenuOpen"
                class="sm:hidden"
                id="mobile-menu">
                <div class="space-y-1 pt-2 pb-3">
                <!-- Current: "bg-gray-50 border-gray-800 text-gray-700", Default: "border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700" -->
                <a
                    href="#"
                    class="block border-l-4 border-gray-800 bg-gray-50 py-2 pl-3 pr-4 text-base font-medium text-gray-700"
                    >Discover</a
                >
                <a
                    href="#"
                    class="block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-500 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700"
                    >For You</a
                >
                <a
                    href="#"
                    class="block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-500 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700"
                    >People</a
                >
                </div>
                <div class="border-t border-gray-200 pt-4 pb-3">
                <div class="flex items-center px-4">
                    <div class="flex-shrink-0">
                    <img
                        class="h-10 w-10 rounded-full"
                        src="{{ !is_null(auth()->user()->image) ? url('storage/'.auth()->user()->image) : 'https://picsum.photos/200/300' }}"
                        alt="Placeholder Image" />
                    </div>
                    <div class="ml-3">
                    <div class="text-base font-medium text-gray-800">
                        {{ auth()->user()->name }}
                    </div>
                    <div class="text-sm font-medium text-gray-500">{{ auth()->user()->email }}</div>
                    </div>
                </div>
                <div class="mt-3 space-y-1">
                    <a
                    href="#"
                    class="block px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800"
                    >Create New Post</a
                    >
                    <a
                    href="{{ route('profiles.show',auth()->user()->id) }}"
                    class="block px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800"
                    >Your Profile</a
                    >
                    <a
                    href="{{ route('profiles.edit',auth()->user()->id) }}"
                    class="block px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800"
                    >Edit Profile</a
                    >
                    <form action="{{ route('auth.logout') }}" method="POST" class="block px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800">
                        @csrf
                        <button type="submit" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                            Sign out
                        </button>
                    </form>
                </div>
                </div>
            </div>
        </nav>
    </x-dashboard.navbar>
    <!-- Variable Components -->
    <main class="container max-w-2xl mx-auto space-y-8 mt-8 px-2 min-h-screen">
        {{ $profile ?? '' }}
        {{ $editProfile ?? '' }}
        {{ $createPost ?? '' }}
        {{ $postDetails ?? '' }}
        {{ $editPost ?? '' }}
        <!-- News Feed -->
        @foreach ($posts as $post)
            <section id="newsfeed" class="space-y-6">
                <!-- Barta Card -->
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
                                src="{{ !is_null($post->image) ? url('storage/'.$post->image) : 'https://picsum.photos/200/300'  }}"
                                alt="{{ $post->author }}" />
                            </div>
                            <!-- /User Avatar -->
                
                            <!-- User Info -->
                            <div class="text-gray-900 flex flex-col min-w-0 flex-1">
                                <a
                                href="https://github.com/alnahian2003"
                                class="hover:underline font-semibold line-clamp-1">
                                {{ $post->author }}
                                </a>
                
                                <a
                                href="https://twitter.com/alnahian2003"
                                class="hover:underline text-sm text-gray-500 line-clamp-1">
                                {{ '@'.$post->username }}
                                </a>
                            </div>
                            <!-- /User Info -->
                            </div>
                
                            @if ($post->user_id == auth()->user()->id)
                                <!-- Card Action Dropdown -->
                                <div class="flex flex-shrink-0 self-center" x-data="{ open: false }">
                                    <div class="relative inline-block text-left">
                                        <div>
                                            <button
                                            @click="open = !open"
                                            type="button"
                                            class="-m-2 flex items-center rounded-full p-2 text-gray-400 hover:text-gray-600"
                                            id="menu-0-button">
                                            <span class="sr-only">Open options</span>
                                            <svg
                                                class="h-5 w-5"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                                aria-hidden="true">
                                                <path
                                                d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z"></path>
                                            </svg>
                                            </button>
                                        </div>
                                        <!-- Dropdown menu -->
                                        <div
                                                x-show="open"
                                                @click.away="open = false"
                                                class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                                role="menu"
                                                aria-orientation="vertical"
                                                aria-labelledby="user-menu-button"
                                                tabindex="-1">
                                                <a href="{{ route('posts.show',$post->id) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-0">
                                                    View Details
                                                </a>
                                            <a
                                                    href="{{ route('posts.edit',$post->id) }}"
                                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                    role="menuitem"
                                                    tabindex="-1"
                                                    id="user-menu-item-1"
                                            >Edit</a
                                            >
                                            <form action="{{ route('posts.destroy',$post->id) }}" method="POST" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" role="menuitem" tabindex="-1" id="user-menu-item-2">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                                <!-- /Card Action Dropdown -->
                            @endif
                        </div>
                    </header>
            
                    <!-- Content -->
                    <div class="py-4 text-gray-700 font-normal">
                        <p>
                            {{ str($post->description)->limit(500) }}
                        </p>
                    </div>
            
                    <!-- Date Created & View Stat -->
                    <div class="flex items-center gap-2 text-gray-500 text-xs my-2">
                    <span class="">6 minutes ago</span>
                    <span class="">•</span>
                    <span>450 views</span>
                    </div>
            
                    <!-- Barta Card Bottom -->
                    <footer class="border-t border-gray-200 pt-2">
                        <!-- Card Bottom Action Buttons -->
                        <div class="flex items-center justify-between">
                            <div class="flex gap-8 text-gray-600">
                            <!-- Heart Button -->
                            <button
                                type="button"
                                class="-m-2 flex gap-2 text-xs items-center rounded-full p-2 text-gray-600 hover:text-gray-800">
                                <span class="sr-only">Like</span>
                                <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                class="w-5 h-5">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                </svg>
                
                                <p>36</p>
                            </button>
                            <!-- /Heart Button -->
                
                            <!-- Comment Button -->
                            <button
                                type="button"
                                class="-m-2 flex gap-2 text-xs items-center rounded-full p-2 text-gray-600 hover:text-gray-800">
                                <span class="sr-only">Comment</span>
                                <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                class="w-5 h-5">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z" />
                                </svg>
                
                                <p>17</p>
                            </button>
                            <!-- /Comment Button -->
                            </div>
                
                            <div>
                            <!-- Share Button -->
                            <button
                                type="button"
                                class="-m-2 flex gap-2 text-xs items-center rounded-full p-2 text-gray-600 hover:text-gray-800">
                                <span class="sr-only">Share</span>
                                <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-5 h-5">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z" />
                                </svg>
                            </button>
                            <!-- /Share Button -->
                            </div>
                        </div>
                        <!-- /Card Bottom Action Buttons -->
                    </footer>
                    <!-- /Barta Card Bottom -->
                </article>
                <!-- /Barta Card -->
            </section>
        @endforeach
    </main>
</body>
</html>