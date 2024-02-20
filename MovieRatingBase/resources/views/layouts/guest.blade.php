<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-inter bg-backgc bg-sky-950 text-50 antialiased">
        <div class="min-h-screen flex flex-col justify-center items-center">

            <div class="sm:w-full sm:max-w-md px-6 bg-nav shadow-md overflow-hidden font-meduim">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
