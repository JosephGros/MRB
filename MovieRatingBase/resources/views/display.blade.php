<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MRB</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />


    <!-- Styles -->
    @Vite('resources/css/app.css')
    <script src="https://kit.fontawesome.com/a0315d2788.js" crossorigin="anonymous"></script>
</head>

<body class="antialiased bg-backgc">

@include('layouts.nav')

    <h1 class="text-center text-50 text-3xl font-bold font-inter pt-[60px] ">Lord of The Rings</h1>
    <h2 class="text-center text-50 font-inter">The return of the king</h2>

    <!-- Movie display -->
<div class="flex justify-center">


    <div class="bg-nav mr-4 ml-4 mt-6 rounded-md shadow-2xl md:w-[1100px]">

        <div class="grid grid-cols-3 gap-2 pt-2 pl-2 pr-2 md:pl-8">
            <!-- Img for movie -->
            <div class="col-span-1">
                <img class="h-[120px] w-auto rounded-lg md:h-[400px] " src="{{ vite::asset('images/lotr3.jpg') }}" alt="Lord of the rings 3">
            </div>
  
            <!-- Trailer for movie -->
            <div class="col-span-2">
                <img class="h-[120px] w-auto rounded-lg md:h-[400px]" src="{{ vite::asset('images/lotr3-1.jpg') }}" alt="Lord of the rings 3">
            </div>

        </div>

        <!-- Text description on movie -->
        <div class="flex justify-center mt-4 md:justify-start md:bg-backgc md:w-[450px]">
            <p class="text-center text-50 text-xs font-inter font-medium w-2/3 md:text-lg md:ml-8 md:w-none">Gandalf and Aragorn lead the World of Men against Sauron's army to draw his gaze from Frodo and Sam as they approach Mount Doom with the One Ring.</p>
        </div>

        <section class="bg-sky-600 mt-4 md:w-[450px] md:bg-nav">
            <!-- Genre, Time, Year and Rating -->
            <div class="text-center text-xs text-50 font-inter mt-4 mb-2 md:text-base">Action | Adventure | Drama</div>
            <div class="text-xs text-50 font-inter flex justify-center md:text-base">2003 | 3h 21m | 9.0/10 
                <img class="h-4 w-auto md:h-8" src="{{ vite::asset('images/astro-like-removebg.png') }}" alt="Rating logo">
            </div>

            <!-- Add to watchlist, create new list, rating, share movie, Cast and Find more movies like this -->
            <div class="grid grid-cols-3 gap-2 p-6 md:grid-cols-4">
                <button class="bg-backgc rounded-md text-50 text-xs font-medium md:text-base">Watchlist +</button>
                <button class="bg-backgc rounded-md text-50 text-xs font-medium px-4 ml-1 md:text-bas">List +</button>
                <button class="bg-backgc rounded-md text-50 text-xs pl-6 ml-1 md:pl-2"><img class="h-10 w-auto md:h-14 md:w-auto" src="{{ vite::asset('images/astro-like-removebg.png') }}" alt="Rating logo"></button>
                <button class="bg-backgc rounded-md px-4 mb-10 h-10 w-auto md:h-16 md:w-auto"><i class="fa-solid fa-share-nodes fa-xl" style="color: #f0f9ff;"></i></button>
                <button class="bg-backgc rounded-md text-50 text-xs font-medium mb-10 px-4 ml-1 md:text-base md:hidden">Cast</button>
                <button class="bg-backgc rounded-md text-50 text-xs font-medium mb-10 ml-1 md:text-base md:hidden">More like this</button>
            </div>
        </section>

        <!-- Top 3 cast -->
        <section>
                <p class="text-center text-50 font-inter font-medium mt-4">Top cast</p>
                <div class="grid grid-cols-3 gap-2 p-2">
                    <div class="pl-1">
                        <img class="h-[100px] w-[100px] rounded-full border-solid border-2 border-400" src="{{ vite::asset('images/elijah.jpg') }}" alt="Elijah Wood">
                        <p class="text-center text-50 text-xs font-medium font-inter pt-2">Elijah Wood <br> <span class="text-xs font-light">Frodo</span></p>
                    </div>
                    <div class="pl-1">
                        <img class="h-[100px] w-[100px] rounded-full border-solid border-2 border-400" src="{{ vite::asset('images/ian.jpg') }}" alt="Ian McKellan">
                        <p class="text-center text-50 text-xs font-medium font-inter pt-2">Ian McKellan <br> <span class="text-xs font-light">Gandalf</span></p>
                    </div>
                    <div class="pl-1">
                        <img class="h-[100px] w-[100px] rounded-full border-solid border-2 border-400" src="{{ vite::asset('images/viggo.jpg') }}" alt="Elijah Wood">
                        <p class="text-center text-50 text-xs font-medium font-inter pt-2">Viggo Mortensen <br> <span class="text-xs font-light">Aragon</span></p>
                    </div>
                </div>
        </section>

        <!-- Directors and Writers -->
        <section class="mt-10 border-t-[20px] border-sky-600">
            <p class="text-50 font-medium ml-1 mr-1 border-b-2 border-50">Director - <span class="text-xs font-light">Peter Jackson</span></p>
            <p class="text-50 font-medium ml-1">Writers - <br><span class="text-xs font-light">J.R.R Tolkien | Fran Walsh | Philippa Boyens</span></p>
        </section>

        <!-- More movies like this -->
        <section class="pb-4">
            <p class="text-center text-50 font-inter font-medium mt-4 border-t-[20px] border-sky-600">More like this</p>

                <div class="grid grid-cols-3 gap-2 p-2">
                    <div>
                        <img class="h-[140px] w-auto rounded-lg" src="{{ vite::asset('images/lotr1.jpg') }}" alt="Lord of the rings 1">
                    </div>
                    <div>
                        <img class="h-[140px] w-auto rounded-lg" src="{{ vite::asset('images/lotr2.jpg') }}" alt="Lord of the rings 2">
                    </div>
                    <div>
                        <img class="h-[140px] w-auto rounded-lg" src="{{ vite::asset('images/sw3.jpg') }}" alt="Starwars 3">
                    </div>

                </div>

        </section>

        <!-- Reviews -->
        <section class="border-t-[20px] border-b-[20px] border-sky-600 mb-[60px] rounded-b-md">
            <div class="flex">
                <img class="h-12 w-auto" src="{{ vite::asset('images/astro-like-removebg.png') }}" alt="Rating logo">
                <p class="text-50 font-inter font-medium mt-2">User reviews</p>

            </div>
            <!-- review from costumer -->
            <div class="bg-sky-600 rounded-lg flex ml-16 mr-2 mb-4">
                        <p class="text-50 text-xs font-inter ml-2">
                        <img src="{{ vite::asset('images/profil.jpg') }}" alt="Profil bild" class="rounded-lg w-auto h-10 border-solid border-4 border-sky-400 mt-2">Joseph
                        </p>

                    <div class="bg-sky-400 rounded-r-lg ml-2">
                        <div class=" flex">
                            <img class="h-8 w-auto" src="{{ vite::asset('images/astro-like-removebg.png') }}" alt="Rating logo">
                        <p class=" text-50 font-inter font-medium pt-1"> 10/10</p>
                        </div>
                        
                        <p class="text-xs text-50 font-inter p-2 ">A cinematic triumph, "The Return of the King" is a perfect conclusion to the epic trilogy. 
                            Stunning visuals, emotional depth, and impeccable performances make it a masterpiece. 
                            The grand finale delivers on every level, blending intense action with heartfelt moments, 
                            solidifying its place among the greatest film conclusions.</p>
                    </div>
            </div>
        </section>


    </div>
</div>


    @include('layouts.footer')

</body>

</html>