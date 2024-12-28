<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }}</title>
        <script src="https://cdn.tailwindcss.com"></script>

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
        @if (isset($notifications))
            <script>
                var notificationCount = '{{ $notifications->count() }}';
            </script>
        @else
            <script>
                var notificationCount = 0;
            </script>
        @endif
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body>
        @if (isset($notifications))
            <livewire:dashboard.navbar :notifications="$notifications" />
        @endif
        <main class="container max-w-2xl mx-auto space-y-8 mt-8 px-2 min-h-screen">
            {{ $editPost ?? '' }}
            @if (!isset($postDetails))
                <livewire:dashboard.news-feed />
            @endif
            {{ $postDetails ?? '' }}
        </main>
    </body>
    @livewireScripts
</html>
