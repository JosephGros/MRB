@Vite('resources/css/app.css')
<x-app-layout>
    <x-slot name="header">

        <!-- <div class="md:flex"> -->
        <div class="md:grid ms:grid-cols-2">
            <div class="flex pt-2 md:flex md:justify-center md:items-center">
                <!-- Img for movie -->
                <div class="ml-2 md:w-1/3 md:pl-48">
                    <img class="h-[130px] w-auto rounded-lg ml-6 md:h-[400px] md:w-auto md:ml-0" src="{{ Vite::asset('images/insideOut.jpg') }}" alt="Inside out">
                    <div class="text-xs text-sky-50 font-inter font-light mt-4 mb-2 mr-2 md:text-lg md:font-light">Action | Adventure | Drama</div>
                <div class="flex">
                        <div class="text-xs text-sky-50 font-inter font-light mt-1 md:text-lg md:font-light">2003 | 3h 21m | 9.0/10</div>
                        <img class="h-6 w-auto md:h-8" src="{{ vite::asset('images/astro-like-removebg.png') }}" alt="Rating logo">
                    </div>
                </div>
    
                <!-- Trailer for movie -->
                <div class="basis-1/2 md:basis-none md:w-1/2">
                    <img class="h-[185px] w-auto rounded-lg border-solid border-2 border-sky-600 ml-2 md:h-[500px] md:w-auto md:border-4 md:ml-6" src="{{ Vite::asset('images/insideOut1.jpg') }}" alt="Inside out">
                </div>

            </div>

            <!-- buttons for add to watchlist, create new list, rating, share movie, Cast and Find more movies like this -->
            <div class="w-1/2">
                    <div class="flex ml-2 mt-2 md:justify-center">
                                <button class="bg-sky-950 rounded-md text-sky-50 text-xs font-light h-8 px-2 md:text-base md:h-16 md:bg-sky-700">Watchlist +</button>
                                <button class="bg-sky-950 rounded-md text-sky-50 text-xs font-light h-8 px-4 ml-1 md:text-base md:h-16 md:bg-sky-700">List +</button>
                                <a class="bg-sky-950 rounded-md text-xs flex justify-center ml-1 items-center mb-4 h-8 w-8 md:pl-2 md:h-16 md:w-auto md:bg-sky-700"><img class="h-6 w-auto md:h-14 md:w-auto md:pl-2" src="{{ vite::asset('images/astro-like-removebg.png') }}" alt="Rating logo"></a>
                    </div>
            </div>
        </div>


        <!-- Hidden movies on smaller screen -->
        <div class="hidden md:contents">
            <div class="md:flex md:justify-center md:items-center">

                <!-- Movie 1 -->
                <div class="md:mt-2">
                    <div class="bg-sky-600 rounded-lg flex ml-16 mr-2 mb-4 ">
                            <img src="{{ vite::asset('images/lotr.jpg') }}" alt="Lord of the rings - The return of the king" class="rounded-l-lg w-auto h-60">

                        <div class="bg-sky-300/50 rounded-r-lg ml-2 ">

                            <p class="text-sky-50 text-center">Lord of The Rings <br> <span class="text-xs font-light">The return of the king</span></p>    

                                <p class="text-xs text-sky-50 font-inter p-2 md:text-sm">
                                    Gandalf and Aragorn lead the World of Men against Sauron's 
                                    army to draw his gaze from Frodo and Sam as they approach
                                    Mount Doom with the One Ring.</p>
                         <!-- Genre, Time, Year and Rating -->
                         <div class="flex justify-center">
                            <div class="text-sm text-sky-50 font-inter mt-2">2003 | 3h 21m | 9.0/10</div>
                                <img class="h-4 w-auto md:h-8" src="{{ vite::asset('images/astro-like-removebg.png') }}" alt="Rating logo">
                            </div>
                            <div class="text-center text-sm text-sky-50 font-inter mb-2">Action | Adventure | Drama</div>

                            <div class="flex ml-2 mt-2 md:justify-center">
                                <button class="bg-sky-950 rounded-md text-sky-50 text-xs font-light h-8 px-4 ml-1 md:text-base md:h-16 md:bg-sky-700">Watch</button>
                                <button class="bg-sky-950 rounded-md text-sky-50 text-xs font-light h-8 px-2 md:text-base md:h-16 md:bg-sky-700">Watchlist +</button>
                                <a class="bg-sky-950 rounded-md text-xs flex justify-center ml-1 items-center mb-4 h-8 w-8 md:pl-2 md:h-16 md:w-auto md:bg-sky-700"><img class="h-6 w-auto md:h-14 md:w-auto md:pl-2" src="{{ vite::asset('images/astro-like-removebg.png') }}" alt="Rating logo"></a>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Movie 2 -->
                <div class="md:mt-2">
                    <div class="bg-sky-600 rounded-lg flex ml-16 mr-2 mb-4 ">

                        <!-- Movie image -->
                        <img src="{{ vite::asset('images/oppenheimer.jpg') }}" alt="Profil bild" class="rounded-l-lg w-auto h-60">

                        <!-- Movie description -->
                        <div class="bg-sky-300/50 rounded-r-lg ml-2 ">
                            <p class="text-sky-50 font-inter font-medium pt-1 text-center">Oppenheimer</p>                 
                            <p class="text-xs text-sky-50 font-inter p-2 md:text-sm">The story of American scientist J. Robert Oppenheimer and his role in the development of the atomic bomb..</p>
                             <!-- Genre, Time, Year and Rating -->
                            <div class="flex justify-center">
                                <div class="text-sm text-sky-50 font-inter mt-2">2003 | 3h 21m | 9.0/10</div>
                                <img class="h-4 w-auto md:h-8" src="{{ vite::asset('images/astro-like-removebg.png') }}" alt="Rating logo">
                            </div>
                            <div class="text-center text-sm text-sky-50 font-inter mb-2">Action | Adventure | Drama</div>

                            <div class="flex ml-2 mt-2 md:justify-center">
                                <a class="bg-sky-950 rounded-md text-sky-50 text-xs font-light h-8 px-4 ml-1 md:text-base md:h-16 md:bg-sky-700">Watch</a>
                                <button class="bg-sky-950 rounded-md text-sky-50 text-xs font-light h-8 px-2 md:text-base md:h-16 md:bg-sky-700">Watchlist +</button>
                                <a class="bg-sky-950 rounded-md text-xs flex justify-center ml-1 items-center mb-4 h-8 w-8 md:pl-2 md:h-16 md:w-auto md:bg-sky-700"><img class="h-6 w-auto md:h-14 md:w-auto md:pl-2" src="{{ vite::asset('images/astro-like-removebg.png') }}" alt="Rating logo"></a>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Movie 3 -->
                <div class="md:mt-2">
                    <div class="bg-sky-600 rounded-lg flex mr-2 mb-4 ">
                            <img src="{{ vite::asset('images/thg.jpg') }}" alt="The Hunger Games - The Ballad of Songbirds and Snakes" class="rounded-l-lg w-auto h-60">


                        <div class="bg-sky-300/50 rounded-r-lg ml-2 ">

                            <p class="text-sky-50 text-center text-base font-inter font-medium pt-1">The Hunger Games <br> <span class="font-light text-xs">The Ballad of Songbirds and Snakes</span></p>
                                            
                            <p class="text-sky-50 font-inter text-center p-2 md:text-sm">Coriolanus Snow mentors and develops feelings for the female District 12 tribute during the 10th Hunger Games.</p>
                            <!-- Genre, Time, Year and Rating -->
                            <div class="flex justify-center">
                            <div class="text-sm text-sky-50 font-inter mt-2">2003 | 3h 21m | 9.0/10</div>
                                <img class="h-4 w-auto md:h-8" src="{{ vite::asset('images/astro-like-removebg.png') }}" alt="Rating logo">
                            </div>
                            <div class="text-center text-sm text-sky-50 font-inter mb-2">Action | Adventure | Drama</div>

                            <div class="flex ml-2 mt-2 md:justify-center">
                                <button class="bg-sky-950 rounded-md text-sky-50 text-xs font-light h-8 px-4 ml-1 md:text-base md:h-16 md:bg-sky-700">Watch</button>
                                <button class="bg-sky-950 rounded-md text-sky-50 text-xs font-light h-8 px-2 md:text-base md:h-16 md:bg-sky-700">Watchlist +</button>
                                <a href="#" role="link" class="bg-sky-950 rounded-md text-xs flex justify-center ml-1 items-center mb-4 h-8 w-8 md:pl-2 md:h-16 md:w-auto md:bg-sky-700"><img class="h-6 w-auto md:h-14 md:w-auto md:pl-2" src="{{ vite::asset('images/astro-like-removebg.png') }}" alt="Rating logo"></a>
                            </div>
 
                        </div>
                    </div>
                </div>

            
            </div>
        </div>
    </x-slot>

    <!-- Buttons for add watchlist, see all, only movies, only series -->
    <x-slot name="choiceButtons">
        <div class="hidden md:contents">
            <div class="flex justify-center m-8">
                <button class="bg-sky-700 text-sky-50 text-base text-inter rounded-lg h-16">Watchlist +</button>
                <button class="bg-sky-700 text-sky-50 text-base text-inter rounded-lg h-16"> All</button>
                <button class="bg-sky-700 text-sky-50 text-base text-inter rounded-lg h-16"> Series</button>
                <button class="bg-sky-700 text-sky-50 text-base text-inter rounded-lg h-16"> Movies</button>

            </div>

        </div>

    </x-slot>

    <!-- Watchlist (don't show if it is empty) -->
    <x-slot name="watchlistExist">
    <div class="bg-sky-700 border-solid border-y-4 border-sky-800/50">
        <div>
            <h2 class="text-sky-50 ml-2 font-medium pt-2 md:text-2xl">Watchlist</h2>
            <div class="grid grid-cols-3 gap-4 mb-4 md:grid-cols-7 md:gap-1">
                <img class="h-[200px] w-auto rounded-lg border-solid border-4 border-sky-800/50 ml-2" src="{{ Vite::asset('images/insideOut.jpg') }}" alt="Inside out">
                <img class="h-[200px] w-auto rounded-lg border-solid border-4 border-sky-800/50 ml-2" src="{{ Vite::asset('images/overTheHedge.jpg') }}" alt="Over the hedge">
                <img class="h-[200px] w-auto rounded-lg border-solid border-4 border-sky-800/50" src="{{ Vite::asset('images/spiderman3.jpg') }}" alt="Spiderman 3">
            </div>
        </div>

    </div>
    </x-slot>

    <!-- Movie / serie content -->
    <x-slot name="content">
            <div class="bg-sky-700 mb-8 mt-8 border-solid border-y-4 border-sky-800/50">
                <div>
                    <h2 class="text-sky-50 ml-2 font-medium pt-2 md:text-2xl">Action</h2>
                    <div class="grid grid-cols-3 gap-4 mb-4  md:grid-cols-7">
                        <img class="h-[200px] w-auto rounded-lg border-solid border-4 border-sky-800/50 ml-2" src="{{ Vite::asset('images/deadpool.jpg') }}" alt="Deadpool">
                        <img class="h-[200px] w-auto rounded-lg border-solid border-4 border-sky-800/50 ml-2" src="{{ Vite::asset('images/spidermanNoWayHome.jpg') }}" alt="Spiderman no way home">
                        <img class="h-[200px] w-auto rounded-lg border-solid border-4 border-sky-800/50" src="{{ Vite::asset('images/spiderman3.jpg') }}" alt="Spiderman 3">
                    </div>
                </div>

            </div>

            <div class="bg-sky-700 mb-8 border-solid border-y-4 border-sky-800/50">
                <div>
                    <h2 class="text-sky-50 ml-2 font-medium pt-2 md:text-2xl">Drama</h2>
                    <div class="grid grid-cols-3 gap-4 mb-4 md:grid-cols-7">
                        <img class="h-[200px] w-auto rounded-lg border-solid border-4 border-sky-800/50 ml-2" src="{{ Vite::asset('images/deadpool.jpg') }}" alt="Deadpool">
                        <img class="h-[200px] w-auto rounded-lg border-solid border-4 border-sky-800/50 ml-2" src="{{ Vite::asset('images/spidermanNoWayHome.jpg') }}" alt="Spiderman no way home">
                        <img class="h-[200px] w-auto rounded-lg border-solid border-4 border-sky-800/50" src="{{ Vite::asset('images/spiderman3.jpg') }}" alt="Spiderman 3">
                    </div>
                </div>

            </div>

            
            <div class="bg-sky-700 mb-8 border-solid border-y-4 border-sky-800/50">
                <div>
                    <h2 class="text-sky-50 ml-2 font-medium pt-2 md:text-2xl">Comedy</h2>
                    <div class="grid grid-cols-3 gap-4 mb-4 md:grid-cols-7">
                        <img class="h-[200px] w-auto rounded-lg border-solid border-4 border-sky-800/50 ml-2" src="{{ Vite::asset('images/deadpool.jpg') }}" alt="Deadpool">
                        <img class="h-[200px] w-auto rounded-lg border-solid border-4 border-sky-800/50 ml-2" src="{{ Vite::asset('images/spidermanNoWayHome.jpg') }}" alt="Spiderman no way home">
                        <img class="h-[200px] w-auto rounded-lg border-solid border-4 border-sky-800/50" src="{{ Vite::asset('images/spiderman3.jpg') }}" alt="Spiderman 3">
                    </div>
                </div>

            </div>
    </x-slot>

    


</x-app-layout>
