<x-app-layout>
<x-slot name="header">
        <!-- <div class="md:flex"> -->
        <div class="md:grid ms:grid-cols-2">
            <div class="flex pt-2 md:flex md:justify-center md:items-center">

                <!-- Img for movie -->
                <div class="ml-2 md:w-1/3 md:pl-32 2xl:pl-48">
                    <img class="h-[130px] w-auto rounded-lg ml-6 md:h-[400px] md:w-auto md:ml-0" src="{{ asset('/images/insideOut.jpg') }}" alt="Inside out">
                    <div class="text-xs text-sky-50 font-inter font-light mt-4 mb-2 mr-2 md:text-lg md:font-light md:ml-4">Action | Adventure | Drama</div>
                        <div class="flex">
                            <div class="text-xs text-sky-50 font-inter font-light mt-1 md:text-lg md:font-light md:ml-4">2003 | 3h 21m | 9.0/10</div>
                            <img class="h-6 w-auto md:h-8" src="{{ asset('/images/astro-like-removebg.png') }}" alt="Rating logo">
                        </div>
                </div>
    
                <!-- Trailer for movie -->
                <div class="basis-1/2 md:basis-none md:w-1/2">
                    <img class="h-[185px] w-auto rounded-lg border-solid border-2 border-sky-600 ml-2 md:h-[500px] md:w-auto md:border-4 md:ml-6" src="{{ asset('/images/insideOut1.jpg') }}" alt="Inside out">
                </div>

            </div>

            <!-- buttons for add to watchlist, create new list, rating, share movie, Cast and Find more movies like this -->
            <div class="w-1/2">
                    <div class="flex ml-2 mt-2 md:justify-center 2xl:-ml-2">
                        <x-primary-button class="mb-2">Watchlist +</x-primary-button>
                        <x-primary-button>List +</x-primary-button>
                        <x-primary-button> 
                            <img class="h-6 w-auto md:h-12 md:w-auto" src="{{ asset('/images/astro-like-removebg.png') }}" alt="Rating logo">
                       </x-primary-button>
                    </div>
            </div>
        </div>


        <!-- Hidden movies on smaller screen -->
        <div class="hidden md:contents">
            <div class="md:flex md:justify-center md:items-center">

                <!-- Movie 1 -->
                <div class="md:mt-2 md:w-1/3">
                    <div class="rounded-lg flex ml-2 mr-2 mb-4">
                            <img src="{{ asset('/images/lotr.jpg') }}" alt="Lord of the rings - The return of the king" class="rounded-l-lg w-auto h-auto">

                        <div class="bg-sky-700 rounded-r-lg">

                            <p class="text-sky-50 text-center md:text-base 2xl:text-xl">Lord of The Rings <br> <span class="md:text-sm 2xl:text-base md:font-light 2xl:font-light">The return of the king</span></p>    

                                <p class="text-sky-50 text-center font-inter p-2 md:text-sm 2xl:text-base">
                                    Gandalf and Aragorn lead the World of Men against Sauron's 
                                    army to draw his gaze from Frodo and Sam.</p>
                            <!-- Genre, Time, Year and Rating -->
                            <div class="flex justify-center">
                                <div class="text-sm text-sky-50 font-inter mt-2">2003 | 3h 21m | 9.0/10</div>
                                <img class="h-4 w-auto md:h-8" src="{{ asset('/images/astro-like-removebg.png') }}" alt="Rating logo">
                            </div>
                            <div class="text-center text-sm text-sky-50 font-inter mb-2">Action | Adventure | Drama</div>

                            <div class="flex ml-2 mt-2 md:justify-center">
                                <x-button-dark>Watch</x-button-dark>
                                <x-button-dark>Watchlist +</x-button-dark>
                                <x-button-dark><img class="md:h-8 md:w-auto 2xl:h-12 2xl:w-auto" src="{{ asset('/images/astro-like-removebg.png') }}" alt="Rating logo"></x-button-dark>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Movie 2 -->
                <div class="md:mt-2 md:w-1/3">
                    <div class="rounded-lg flex ml-2 mr-2 mb-4 ">

                        <!-- Movie image -->
                        <img src="{{ asset('/images/oppenheimer.jpg') }}" alt="Profil bild" class="rounded-l-lg w-auto h-auto">

                        <!-- Movie description -->
                        <div class="bg-sky-700 rounded-r-lg">
                            <p class="text-sky-50 text-center md:text-base 2xl:text-xl">Oppenheimer</p>  
                                          
                            <p class="text-sky-50 text-center font-inter p-2 md:text-sm 2xl:text-base">The story of American scientist J. Robert Oppenheimer and his role in the development of the atomic bomb..</p>
                            
                            <!-- Genre, Time, Year and Rating -->
                            <div class="flex justify-center">
                                <div class="text-sm text-sky-50 font-inter mt-2">2003 | 3h 21m | 9.0/10</div>
                                <img class="h-4 w-auto md:h-8" src="{{ asset('/images/astro-like-removebg.png') }}" alt="Rating logo">
                            </div>
                            <div class="text-center text-sm text-sky-50 font-inter mb-2">Action | Adventure | Drama</div>

                            <div class="flex ml-2 mt-2 md:justify-center md:end-px">
                                <x-button-dark>Watch</x-button-dark>
                                <x-button-dark>Watchlist +</x-button-dark>
                                <x-button-dark><img class="md:h-8 md:w-auto 2xl:h-12 2xl:w-auto" src="{{ asset('/images/astro-like-removebg.png') }}" alt="Rating logo"></x-button-dark>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Movie 3 -->
                <div class="md:mt-2 md:w-1/3">
                    <div class="rounded-lg flex ml-2 mr-2 mb-4 ">
                        <img src="{{ asset('/images/thg.jpg') }}" alt="The Hunger Games - The Ballad of Songbirds and Snakes" class="rounded-l-lg w-auto h-auto">


                        <div class="bg-sky-700 rounded-r-lg">

                            <p class="text-sky-50 text-center md:text-base 2xl:text-xl">The Hunger Games <br> <span class="md:text-sm 2xl:text-base md:font-light 2xl:font-light">The Ballad of Songbirds and Snakes</span></p>
                                            
                            <p class="text-sky-50 text-center font-inter p-2 md:text-sm 2xl:text-base">Coriolanus Snow mentors and develops feelings for the female District 12 tribute during the 10th Hunger Games.</p>
                            <!-- Genre, Time, Year and Rating -->
                            <div class="flex justify-center">
                                <div class="text-sm text-sky-50 font-inter mt-2">2003 | 3h 21m | 9.0/10</div>
                                <img class="h-4 w-auto md:h-8" src="{{ asset('/images/astro-like-removebg.png') }}" alt="Rating logo">
                            </div>
                            <div class="text-center text-sm text-sky-50 font-inter mb-2">Action | Adventure | Drama</div>

                            <div class="flex ml-2 mt-2 md:justify-center">
                                <x-button-dark>Watch</x-button-dark>
                                <x-button-dark>Watchlist +</x-button-dark>
                                <x-button-dark><img class="md:h-8 md:w-auto 2xl:h-12 2xl:w-auto" src="{{ asset('/images/astro-like-removebg.png') }}" alt="Rating logo"></x-button-dark>
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
                <x-primary-btn>Watchlist +</x-primary-btn>
                <x-primary-btn class="ml-8">All</x-primary-btn>
                <x-primary-btn class="ml-8">Series</x-primary-btn>
                <x-primary-btn class="ml-8">Movies</x-primary-btn>
            </div>
        </div>
    </x-slot>

    <!-- Watchlist (don't show if it is empty) -->
    <x-slot name="watchlistExist">
        
            <div class="bg-sky-700 border-solid border-y-4 border-sky-800/50 md:rounded-lg">
                <div>
                <a href="{{ route('watchlist.dashboardWatchlist', ['user' => Auth::user()]) }}"> <h2 class="text-sky-50 ml-2 font-medium pt-2 md:text-2xl">Watchlist</h2></a>
                
                    <!-- <div class="grid grid-cols-3 gap-4 mb-4 md:grid-cols-7 2xl:grid-cols-10 2xl:gap-2"> -->
                    <div id="default-carousel" class="relative w-full" data-carousel="slide">
                    <!-- Carousel wrapper -->
                    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                    @foreach($limit as $movie)
                        <div>
                            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                <img class="h-[300px] w-[250px] rounded-lg border-solid border-4 border-sky-800/50 ml-2 absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" src="{{ $movie->poster }}" alt=" {{ $movie->name }}">
                                <h3>{{ $movie->name }}</h3>
                            </div>
                        </div>
                    @endforeach     
                    
                    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
        <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
    </div>
    <!-- Slider controls -->
    <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>
                    </div>
                </div>
            </div>



            

            
            <!-- <img src="/docs/images/carousel/carousel-2.svg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
    
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="/docs/images/carousel/carousel-2.svg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>

        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="/docs/images/carousel/carousel-3.svg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
      
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="/docs/images/carousel/carousel-4.svg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>

        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="/docs/images/carousel/carousel-5.svg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
    </div> -->
    <!-- Slider indicators -->
    

       
    </x-slot>

        <!-- Movie / serie content -->
        @section('content')
            @foreach($latestInGenre as $genre)
                    <div class="bg-sky-700 mb-8 mt-8 border-solid border-y-4 border-sky-800/50 md:rounded-lg">
                        <div>
                        <a href="{{ route('genres.show', ['id' => $genre['id']]) }}"> <h2 class="text-sky-50 ml-2 font-medium pt-2 md:text-2xl">{{ $genre['name'] }}</h2></a>
                            <div class="grid grid-cols-3 gap-4 mb-4 md:grid-cols-7 2xl:grid-cols-10 2xl:gap-2">

                                    @foreach($genre['items'] as $item)
                                        <div class="relative">
                                            <img class="h-[200px] w-[250px] rounded-lg border-solid border-4 border-sky-800/50 ml-2" role="button" aria-label="add to watchlist" src="{{ $item->poster }}" alt="{{ $item->name }}">
                                            <button class="absolute top-0 bg-blue-500 text-white p-2 rounded hover:bg-blue-800 m-2">+</button>
                                        </div>
                                     
                                    @endforeach

                            </div>
                        </div>
                    </div>
            @endforeach


        @endsection
            
        </x-app-layout>