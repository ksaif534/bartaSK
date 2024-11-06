<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        @livewireStyles
    </head>
    <body>
        <livewire:dashboard.navbar />
        <main class="container max-w-2xl mx-auto space-y-8 mt-8 px-2 min-h-screen">
            {{ $editPost ?? '' }}
            <livewire:dashboard.news-feed />
        </main>
    </body>
    @livewireScripts
</html>
