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
                            <img src="{{$randomItem->poster}}" alt="{{$randomItem->name}}" class="rounded-l-lg w-[200px] h-[300px]] ml-4">

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
                                    <x-button-dark>
                                        <a href="#">Watch</a>
                                    </x-button-dark>

                                    <x-button-dark>
                                        <a href=" {{ route('watchlist.index', ['id' => Auth::id()]) }}">Watchlist +</a>
                                    </x-button-dark>
                                    <x-button-dark>
                                        <a href="{{ route('reviews.create') }}">
                                            <img class="md:h-8 md:w-auto 2xl:h-12 2xl:w-auto" src="{{ asset('/images/astro-like-removebg.png') }}" alt="Rating logo">
                                        </a>
                                    </x-button-dark>
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
                    <a href=" {{ route('watchlist.index', ['id' => Auth::id()]) }}">Watchlist +</a>
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
       
            <div class="bg-sky-700 border-solid border-y-4 border-sky-800/50 md:rounded-lg">          
                <div>
                    <!-- <a href="{{ route('watchlist.index', ['id' => Auth::id()]) }}"> <h2 class="text-sky-50 ml-2 font-medium pt-2 md:text-2xl">Watchlist</h2></a> -->
                
                    <div id="watchlistContainer" class="relative">
                        <div id="watchlistCarousel">
                            <a href="{{ route('watchlist.index', ['id' => Auth::id()]) }}">
                            <h2 class="text-sky-50 ml-2 font-medium pt-2 md:text-2xl">Watchlist</h2>
                            </a>
                            <div class="overflow-x-auto whitespace-nowrap py-4 px-2 md:px-4 scrollbar-thin scrollbar-thumb-sky-800 scrollbar-track-sky-700">
                            <!-- <div class="grid grid-cols-3 gap-4 mb-4 md:grid-cols-7 2xl:grid-cols-10 2xl:gap-2"> -->
                                @foreach($limit as $movie)
                                    @if(empty($limit))
                                    <p class="text-sky-50 ml-2 font-medium pt-2 md:text-xl">No Movies/ Series in your watchlist</p>
                                    @else
                                    <div class="inline-block w-[50%] md:w-[25%] lg:w-[20%] xl:w-[15%] h-auto p-4 mx-1.5">
                                    <div class="relative h-[250px] w-[175px]">
                                    <img class="w-[175px] h-[250px] rounded-lg border-solid border-4 border-sky-800/50 object-fit" src="{{ $movie->poster }}" alt="{{ $movie->name }}">
                                    @if(auth()->user()->watchlist->contains('media_id', $movie->id))
                                        <form method="POST" action="{{ route('watchlist.destroy', ['id' => $movie->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="absolute flex items-center justify-center w-[30px] inset-x-0 top-0 h-8 bg-blue-950 rounded hover:bg-blue-800 m-1 bg-opacity-75">
                                                <span class="material-symbols-outlined text-sky-50">bookmark_added</span>
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('watchlist.store') }}">
                                            @csrf
                                            <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                                            <button type="submit" class="absolute flex items-center justify-center w-[30px] inset-x-0 top-0 h-8 bg-blue-950 rounded hover:bg-blue-800 m-1 bg-opacity-75">
                                                <span class="material-symbols-outlined text-sky-50">bookmark_add</span>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

        <!-- Movie / serie content -->
        @section('content')

            @foreach($latestInGenre as $genre)
            <div class="bg-sky-700 mb-8 mt-8 border-solid border-y-4 border-sky-800/50 md:rounded-lg">
                    
                        
                    <a href="{{ route('genres.show', ['id' => $genre['id']]) }}">
                        <h2 class="text-sky-50 ml-2 font-medium pt-2 md:text-2xl">{{ $genre['name'] }}</h2>
                    </a>
                        <!-- Unique IDs for genre container and carousel -->
                        <div id="genreContainer_{{ $genre['id'] }}" class="relative" data-carousel="slide">
                            <div id="genreCarousel_{{ $genre['id'] }}" class="overflow-x-hidden whitespace-nowrap mb-4 max-w-full relative">
                                <div class="flex">
                                    @foreach($genre['items'] as $item)
                                        <div class="inline-block w-[50%] md:w-[25%] lg:w-[20%] xl:w-[15%] h-auto p-4 mx-1.5">
                                            <div class="relative h-[250px] w-[175px]">
                                            <img class="w-[175px] h-[250px] rounded-lg border-solid border-4 border-sky-800/50 object-fit" src="{{ $item->poster }}" alt="{{ $item->name }}">
                                            @if(auth()->user()->watchlist->contains('media_id', $item->id))
                                                <form method="POST" action="{{ route('watchlist.destroy', ['id' => $item->id]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="absolute flex items-center justify-center w-[30px] inset-x-0 top-0 h-8 bg-blue-950 rounded hover:bg-blue-800 m-1 bg-opacity-75">
                                                        <span class="material-symbols-outlined text-sky-50">bookmark_added</span>
                                                    </button>
                                                </form>
                                            @else
                                                <form method="POST" action="{{ route('watchlist.store') }}">
                                                    @csrf
                                                    <input type="hidden" name="movie_id" value="{{ $item->id }}">
                                                    <button type="submit" class="absolute flex items-center justify-center w-[30px] inset-x-0 top-0 h-8 bg-blue-950 rounded hover:bg-blue-800 m-1 bg-opacity-75">
                                                        <span class="material-symbols-outlined text-sky-50">bookmark_add</span>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                </div>
            @endforeach


        @endsection
            
</x-app-layout>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fetch all genre and watchlist containers
            const containers = document.querySelectorAll('[id^="genreContainer_"], #watchlistContainer');
            
            containers.forEach(container => {
                const containerId = container.id;
                const carouselId = containerId.replace('Container', 'Carousel');
                const carousel = document.getElementById(carouselId);
                
                // Check if carousel exists
                if (carousel && carousel.children.length > 0) {
                    // Create and append buttons
                    const prevButton = createButton('&#10094;', -1, carouselId);
                    const nextButton = createButton('&#10095;', 1, carouselId);
                    
                    container.appendChild(prevButton);
                    container.appendChild(nextButton);
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

        // Function to create a button
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

        // Function to scroll carousel
        function scrollCarousel(carouselId, direction) {
            let container = document.getElementById(carouselId);
            let scrollAmount = container.clientWidth / 2 * direction;
            container.scrollBy({
                left: scrollAmount,
                behavior: 'smooth'
            });
        }
</script>


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
                <div class="w-1/2 md:ml-2 md:w-1/3 md:pl-32 2xl:pl-48">
                    <img class="h-[130px] w-auto rounded-lg ml-6 md:h-[400px] md:w-auto md:ml-0" src="{{ $randomItem->poster }}" alt="{{$randomItem->name}}">
                    <div class="grid grid-cols-3 gap-2 p-2">
                        @foreach($randomItem->genres as $genre)
                            <div class="text-sm text-sky-50 font-inter mb-2 flex flex-row flex-wrap ml-4">
                                {{$genre['name']}}
                            </div>
                        @endforeach
                    </div>
                        <div class="flex">
                            <div class="text-xs text-sky-50 font-inter font-light mt-1 ml-4 md:text-lg md:font-light md:ml-4">{{$randomItem->release}} | {{$randomItem->runtime }}| {{$randomItem->rating}}</div>
                            <img class="h-6 w-auto md:h-8" src="{{ asset('/images/astro-like-removebg.png') }}" alt="Rating logo">
                        </div>
                </div>
    
                <!-- Trailer for movie -->
                <div class="basis-1/2 md:basis-none flex justify-center">
                    <iframe class="h-[185px] w-1/2 rounded-lg border-solid border-2 border-sky-600 md:ml-2 md:h-[500px] md:w-auto md:border-4 md:ml-6" src="{{$randomItem->trailer}}" alt="{{$randomItem->name}}" data-id="{{$randomItem->id}}"></iframe>
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