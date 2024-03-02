<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MRB') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,700,0,200" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/search.js'])
</head>
<body class="font-inter bg-sky-950">
    
@include('layouts.navigation')
    <div class="max-h-screen">

       

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-sky-700/50">
                <div class="mt-14">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Buttons that only will show in display -->
        @if (isset($choiceButtons))
            <nav>
                <div class="mt-14">
                    {{ $choiceButtons }}
                </div>
            </nav>
        @endif
     

        <!-- If watchlist exist show, if not don't show this list -->
        @if (isset($watchlistExist))
            <div class="bg-sky-700 md:mx-20 md:rounded-lg">
                <div class="mt-14">
                    {{ $watchlistExist }}
                </div>
            </div>
        @endif


        <!-- Page Content -->
        <main class="md:mx-20">
            @yield('content')
        </main>

        
    </div>

</body>
<footer>
@include('layouts.footer')
</footer>
</html>
