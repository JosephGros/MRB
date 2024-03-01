<x-app-layout>
<x-slot name="header">
        <!-- <div class="md:flex"> -->
        <div class="md:grid ms:grid-cols-2">
        @foreach($randomContent as $randomItem)
        <div id="contentToUpdate">

        
            <!-- Here is where the content will be displayed --> 

        </div>


            <!-- buttons for add to watchlist, create new list, rating, share movie, Cast and Find more movies like this -->
            <div class="w-1/2">
                    <div class="flex ml-2 mt-2 md:justify-center 2xl:-ml-2">
                        <x-primary-button class="mb-2">
                            <a href="{{ route('watchlist.store', ['user' => Auth::id()]) }}">Watchlist +</a>
                        </x-primary-button>
                        <x-primary-button>List +</x-primary-button>
                        <x-primary-button> 
                            <a href="">
                                <img class="h-6 w-auto md:h-12 md:w-auto" src="{{ asset('/images/astro-like-removebg.png') }}" alt="Rating logo">
                            </a>
                       </x-primary-button>
                    </div>
            </div>
            @break
        @endforeach
        </div>


        <!-- Hidden movies on smaller screen -->
        <div class="hidden md:contents">
            <div class="md:flex md:justify-center md:items-center">

                <div class="md:mt-2 md:w-4/5">
                    <div class="rounded-lg flex ml-2 mr-2 mb-4">

                        @foreach($randomContent as $randomItem)
                            <img src="{{$randomItem->poster}}" alt="{{$randomItem->name}}" class="rounded-l-lg w-auto h-auto">

                            <div class="bg-sky-700 rounded-r-lg">

                                <p class="text-sky-50 text-center md:text-base 2xl:text-xl">{{$randomItem->name}}</span></p>    

                                    <p class="text-sky-50 text-center font-inter p-2 md:text-sm 2xl:text-base">
                                        {{$randomItem->description}}</p>
                                <!-- Genre, Time, Year and Rating -->
                                <div class="flex justify-center">
                                    <div class="text-sm text-sky-50 font-inter mt-2">{{$randomItem->release}} | {{$randomItem->runtime}} | 9.0/10</div>
                                    <img class="h-4 w-auto md:h-8" src="{{ asset('/images/astro-like-removebg.png') }}" alt="Rating logo">
                                </div> 
                                @foreach($randomItem->genres as $genre)
                                    <div class="text-center text-sm text-sky-50 font-inter mb-2 flex flex-row flex-wrap justify-center">
                                        {{$genre['name']}}
                                    </div>
                                @endforeach
                                <div class="flex ml-2 mt-2 md:justify-center">
                                    <x-button-dark>Watch</x-button-dark>
                                    <x-button-dark>
                                        <a href=" {{ route('watchlist.index', ['user' => Auth::id()]) }}">Watchlist +</a>
                                    </x-button-dark>
                                    <x-button-dark><img class="md:h-8 md:w-auto 2xl:h-12 2xl:w-auto" src="{{ asset('/images/astro-like-removebg.png') }}" alt="Rating logo"></x-button-dark>
                                </div>

                            </div>
                        @endforeach

                    </div>
                </div>

            </div>
        </div>
    </x-slot>


    <!-- Buttons for add watchlist, see all, only movies, only series -->
    <x-slot name="choiceButtons">
        <div class="hidden md:contents">
            <div class="flex justify-center m-8">
                <x-primary-btn>
                    <a href=" {{ route('watchlist.index', ['user' => Auth::id()]) }}">Watchlist +</a>
                </x-primary-btn>
                <x-primary-btn class="ml-8">
                    <a href="{{ route('dashboard') }}">All</a>
                </x-primary-btn>
                <x-primary-btn class="ml-8">
                    <a href="{{ route('genres.series') }}">Series</a>
                </x-primary-btn>
                <x-primary-btn class="ml-8"> 
                    <a href="{{ route('genres.movies') }}">Movies</a>
                </x-primary-btn>
            </div>
        </div>
    </x-slot>

    <!-- Watchlist (don't show if it is empty) -->
    <x-slot name="watchlistExist">
<<<<<<< HEAD
        
=======
       
>>>>>>> 8303385cd873f8412b4d1e6bcab1970f8f1e6b99
            <div class="bg-sky-700 border-solid border-y-4 border-sky-800/50 md:rounded-lg">
           
                <div>
<<<<<<< HEAD
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
=======
                    <a href="{{ route('watchlist.index', ['user' => Auth::id()]) }}"> <h2 class="text-sky-50 ml-2 font-medium pt-2 md:text-2xl">Watchlist</h2></a>
                
                    <div id="watchlistContainer" class="relative">
                            <div id="watchlistCarousel">
                                <div class="grid grid-cols-3 gap-4 mb-4 md:grid-cols-7 2xl:grid-cols-10 2xl:gap-2">
                                    @foreach($limit as $movie)
                                        @if(empty($limit))
                                        <p class="text-sky-50 ml-2 font-medium pt-2 md:text-xl">No Movies/ Series in your watchlist</p>
                                        @else
                                            <img class="h-[200px] w-auto rounded-lg border-solid border-4 border-sky-800/50 ml-2" src="{{ $movie->poster }}" alt=" {{ $movie->name }}">
                                        @endif
                                    @endforeach 
                                </div>
                            </div>
>>>>>>> 8303385cd873f8412b4d1e6bcab1970f8f1e6b99
                    </div>
                </div>
              
            </div>
<<<<<<< HEAD



            

            
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
    

       
=======
        
>>>>>>> 8303385cd873f8412b4d1e6bcab1970f8f1e6b99
    </x-slot>

        <!-- Movie / serie content -->
        @section('content')

            @foreach($latestInGenre as $genre)
            <div class="bg-sky-700 mb-8 mt-8 border-solid border-y-4 border-sky-800/50 md:rounded-lg">
                    <div>
                        <a href="{{ route('genres.show', ['id' => $genre['id']]) }}"> <h2 class="text-sky-50 ml-2 font-medium pt-2 md:text-2xl">{{ $genre['name'] }}</h2></a>

                        <!-- Unique IDs for genre container and carousel -->
                        <div id="genreContainer_{{ $genre['id'] }}" class="relative">
                            <div id="genreCarousel_{{ $genre['id'] }}">
                                <div class="grid grid-cols-3 gap-4 mb-4 md:grid-cols-7 2xl:grid-cols-10 2xl:gap-2">
                                    @foreach($genre['items'] as $item)
<<<<<<< HEAD
                                        <div class="relative">
                                            <img class="h-[200px] w-[250px] rounded-lg border-solid border-4 border-sky-800/50 ml-2" role="button" aria-label="add to watchlist" src="{{ $item->poster }}" alt="{{ $item->name }}">
                                            <button class="absolute top-0 bg-blue-500 text-white p-2 rounded hover:bg-blue-800 m-2">+</button>
                                        </div>
                                     
=======
                                        <img class="h-[200px] w-auto rounded-lg border-solid border-4 border-sky-800/50 ml-2" role="button" aria-label="add to watchlist" src="{{ $item->poster }}" alt="{{ $item->name }}">
>>>>>>> 8303385cd873f8412b4d1e6bcab1970f8f1e6b99
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


        @endsection
            
        </x-app-layout>

<script>
                document.addEventListener('DOMContentLoaded', function() {
        // Fetch all genre containers
        const genreContainers = document.querySelectorAll('[id^="genreContainer_"]');
        
        genreContainers.forEach(genreContainer => {
            const genreCarouselId = genreContainer.getAttribute('id').replace('genreContainer_', 'genreCarousel_');
            const genreCarousel = document.getElementById(genreCarouselId);
            
            // Check if carousel exists
            if (genreCarousel) {
                // Create and append buttons
                const prevButton = createButton('&#10094;', -1, genreCarouselId);
                const nextButton = createButton('&#10095;', 1, genreCarouselId);
                
                genreContainer.appendChild(prevButton);
                genreContainer.appendChild(nextButton);
            }

            const watchlistContainer = document.getElementById('watchlistContainer');
                const watchlistCarousel = document.getElementById('watchlistCarousel');
                
                // Check if watchlist carousel has content
                if (watchlistCarousel.children.length > 0) {
                    // Create and append buttons if content exists
                    const prevButton = createButton('&#10094;', -1, 'watchlistCarousel');
                    const nextButton = createButton('&#10095;', 1, 'watchlistCarousel');
                    
                    watchlistContainer.appendChild(prevButton);
                    watchlistContainer.appendChild(nextButton);
                }
        });

        // Add event listener to buttons
        document.querySelectorAll('.carousel-button').forEach(button => {
            button.addEventListener('click', function() {
                const carouselId = this.getAttribute('data-carousel');
                const direction = parseInt(this.getAttribute('data-direction'), 10);
                scrollCarousel(carouselId, direction);
            });
        });
    });

    function createButton(text, direction, carouselId) {
        const button = document.createElement('button');
        button.className = 'carousel-button absolute px-4 cursor-pointer bg-sky-950 bg-opacity-85 text-white shadow-lg rounded-lg hover:bg-sky-600';
        button.style.left = direction === -1 ? '4px' : 'auto';
        button.style.right = direction === 1 ? '4px' : 'auto';
        button.style.transform = 'translate(-50%, -50%)';
        button.style.top = '50%';
        button.style.transform = 'translateY(-50%)';
        button.innerHTML = text;
        button.setAttribute('data-direction', direction);
        button.setAttribute('data-carousel', carouselId);
        return button;
    }

    function scrollCarousel(carouselId, direction) {
        let container = document.getElementById(carouselId);
        let scrollAmount = container.clientWidth / 2 * direction;
        container.scrollBy({
            left: scrollAmount,
            behavior: 'smooth'
        });
    }

</script>

<script>
    // Define an array to hold the random content
    var randomContent = @json($randomContent);
    
    // Function to fetch and update random content
    function fetchAndUpdateRandomContent() {
        // Randomly select one of the three data points
        var randomIndex = Math.floor(Math.random() * 3);
        var randomItem = randomContent[randomIndex];

        // Update the specific content with the fetched data
        document.getElementById('contentToUpdate').innerHTML = `
            <div class="flex pt-2 md:flex md:justify-center md:items-center">
                

                <!-- Img for movie -->
                <div class="ml-2 md:w-1/3 md:pl-32 2xl:pl-48">
                    <img class="h-[130px] w-auto rounded-lg ml-6 md:h-[400px] md:w-auto md:ml-0" src="{{ $randomItem->poster }}" alt="{{$randomItem->name}}">
                        @foreach($randomItem->genres as $genre)
                            <div class="text-sm text-sky-50 font-inter mb-2 flex flex-row flex-wrap ml-4">
                                {{$genre['name']}}
                            </div>
                        @endforeach
                        <div class="flex">
                            <div class="text-xs text-sky-50 font-inter font-light mt-1 md:text-lg md:font-light md:ml-4">{{$randomItem->release}} | {{$randomItem->runtime }}| {{$randomItem->rating}}</div>
                            <img class="h-6 w-auto md:h-8" src="{{ asset('/images/astro-like-removebg.png') }}" alt="Rating logo">
                        </div>
                </div>
    
                <!-- Trailer for movie -->
                <div class="basis-1/2 md:basis-none md:w-1/2">
                    <video class="h-[185px] w-auto rounded-lg border-solid border-2 border-sky-600 ml-2 md:h-[500px] md:w-auto md:border-4 md:ml-6" src="{{$randomItem->trailer}}" alt="{{$randomItem->name}}"></video>
                </div>
                
            </div>
        `;
    }

    // Function to fetch and update random content initially
    fetchAndUpdateRandomContent();

    // Set interval to fetch and update random content every 5 minutes (300,000 milliseconds)
    setInterval(fetchAndUpdateRandomContent, 300000); // 300000 milliseconds = 5 minutes

    // Function to fetch and update random content every 24 hours (86,400,000 milliseconds)
    setInterval(fetchAndUpdateRandomContent, 86400000); // 86400000 milliseconds = 24 hours
</script>