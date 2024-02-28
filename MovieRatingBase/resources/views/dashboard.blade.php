<x-app-layout>
<x-slot name="header">
        <!-- <div class="md:flex"> -->
        <div class="md:grid ms:grid-cols-2">
        @foreach($randomContent as $randonItem)
            <div class="flex pt-2 md:flex md:justify-center md:items-center">
               

                <!-- Img for movie -->
                <div class="ml-2 md:w-1/3 md:pl-32 2xl:pl-48">
                    <img class="h-[130px] w-auto rounded-lg ml-6 md:h-[400px] md:w-auto md:ml-0" src="{{ $randonItem->poster }}" alt="{{$randonItem->name}}">
                    <div class="text-xs text-sky-50 font-inter font-light mt-4 mb-2 mr-2 md:text-lg md:font-light md:ml-4">{{$randonItem->genre}} | {{$randonItem->genre}} | {{$randonItem->genre}}</div>
                        <div class="flex">
                            <div class="text-xs text-sky-50 font-inter font-light mt-1 md:text-lg md:font-light md:ml-4">{{$randonItem->relese}} | {{$randonItem->runtime }}| {{$randonItem->rating}}</div>
                            <img class="h-6 w-auto md:h-8" src="{{ asset('/images/astro-like-removebg.png') }}" alt="Rating logo">
                        </div>
                </div>
    
                <!-- Trailer for movie -->
                <div class="basis-1/2 md:basis-none md:w-1/2">
                    <video class="h-[185px] w-auto rounded-lg border-solid border-2 border-sky-600 ml-2 md:h-[500px] md:w-auto md:border-4 md:ml-6" src="{{$randonItem->trailer}}" alt="{{$randonItem->name}}" disableremoteplayback webkit-playsinline playsinline></video>
                </div>
                
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
            @endforeach
        </div>


        <!-- Hidden movies on smaller screen -->
        <div class="hidden md:contents">
            <div class="md:flex md:justify-center md:items-center">

                <div class="md:mt-2 md:w-4/5">
                    <div class="rounded-lg flex ml-2 mr-2 mb-4">
                        @foreach($randomContent as $randonItem)
                                <img src="{{$randonItem->poster}}" alt="{{$randonItem->name}}" class="rounded-l-lg w-auto h-auto">

                            <div class="bg-sky-700 rounded-r-lg">

                                <p class="text-sky-50 text-center md:text-base 2xl:text-xl">{{$randonItem->name}}</span></p>    

                                    <p class="text-sky-50 text-center font-inter p-2 md:text-sm 2xl:text-base">
                                        {{$randonItem->description}}</p>
                                <!-- Genre, Time, Year and Rating -->
                                <div class="flex justify-center">
                                    <div class="text-sm text-sky-50 font-inter mt-2">{{$randonItem->release}} | {{$randonItem->runtime}} | 9.0/10</div>
                                    <img class="h-4 w-auto md:h-8" src="{{ asset('/images/astro-like-removebg.png') }}" alt="Rating logo">
                                </div> 
                                @foreach($randonItem->genres as $genre)
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
       
            <div class="bg-sky-700 border-solid border-y-4 border-sky-800/50 md:rounded-lg">
           
                <div>
                <a href="{{ route('watchlist.index', ['user' => Auth::id()]) }}"> <h2 class="text-sky-50 ml-2 font-medium pt-2 md:text-2xl">Watchlist</h2></a>
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
              
            </div>
        
    </x-slot>

        <!-- Movie / serie content -->
        @section('content')

            @foreach($latestInGenre as $genre)
                    <div class="bg-sky-700 mb-8 mt-8 border-solid border-y-4 border-sky-800/50 md:rounded-lg">
                        <div>
                        <a href="{{ route('genres.show', ['id' => $genre['id']]) }}"> <h2 class="text-sky-50 ml-2 font-medium pt-2 md:text-2xl">{{ $genre['name'] }}</h2></a>
                            <div class="grid grid-cols-3 gap-4 mb-4 md:grid-cols-7 2xl:grid-cols-10 2xl:gap-2">

                                    @foreach($genre['items'] as $item)
                                     
                                        <img class="h-[200px] w-auto rounded-lg border-solid border-4 border-sky-800/50 ml-2" role="button" aria-label="add to watchlist" src="{{ $item->poster }}" alt="{{ $item->name }}">
                                     
                                    @endforeach

                            </div>
                        </div>
                    </div>
            @endforeach


        @endsection
            
        </x-app-layout>

        <script>
            function showTrailer(trailerUrl) {
                // You can implement your own logic to show the trailer
                // For example, you can open a modal or a popover with the trailer video
                // Here, I'm just redirecting the user to the trailer URL
                window.location.href = trailerUrl;
                
                const medias = [
                    $randomContent
                ];

                let media = medias[Math.floor(Math.random())];

                return media;
            }
        </script>