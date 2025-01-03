<!-- Navigation -->
{{-- <x-dashboard.navbar :notifications="$notifications">
    
</x-dashboard.navbar> --}}
<nav
    x-data="{ mobileMenuOpen: false, userMenuOpen: false }"
    class="bg-white shadow">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">
            <div class="flex">
                <div class="flex flex-shrink-0 items-center">
                    <a href="{{ route('dashboard.index') }}" wire:navigate>
                        <h2 class="font-bold text-2xl">Barta</h2>
                    </a>
                </div>
                <!-- Search input -->
                <form action="{{ route('dashboard.search') }}" wire:navigate method="GET" class="flex items-center">
                    <input
                            type="text"
                            placeholder="Search..."
                            name="search"
                            class="border-2 border-gray-300 bg-white h-10 px-5 pr-10 rounded-full text-sm focus:outline-none"
                    />
                    <button type="submit" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2">Search</button>
                </form>
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
                    class="text-gray-900 hover:text-white border-2 border-gray-800 hover:bg-gray-900 focus:ring-2 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center hidden md:block" livewire:navigate>
                    Create Post
                </a>

                <!-- Notification Dropdown -->
                <div class="relative ml-3" x-data="{open: false}">
                    <div>
                        <div id="svg-container">
                            <button
                            @click="open = !open"
                            type="button"
                            class="rounded-full bg-white p-2 text-gray-800 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
                            id="notification-menu-button"
                            aria-expanded="false"
                            aria-haspopup="true"
                            >
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
                                <div class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-gray-500 border-2 border-white rounded-full -top-2 -end-2 dark:border-gray-900">{{ $notifications->count() }}</div>
                            </button>  
                        </div>
                    </div>
                    <!-- Dropdown menu -->
                    <div
                        x-show="open"
                        @click.away="open = false"
                        class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                        role="menu"
                        aria-orientation="vertical"
                        aria-labelledby="notification-menu-button"
                        tabindex="-1">
                        @foreach ($notifications as $notification)
                            <div class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="notification-menu-item-{{ $notification->id }}" wire:click="markAsRead('{{ $notification->id }}')">
                                {{ json_decode($notification->data)->message }}
                            </div>
                        @endforeach
                    </div>
                </div>

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