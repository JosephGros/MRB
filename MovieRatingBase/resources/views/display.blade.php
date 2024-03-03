@vite(['resources/css/app.css'])
<script src="https://kit.fontawesome.com/a0315d2788.js" crossorigin="anonymous"></script>

@if(auth()->check())
<x-app-layout>
    <!-- Title -->
    @section('content')
    @foreach($similarMovies as $similarMovie)
        @if(!$displayedMovies->contains($similarMovie->id ?? $movie->id)) <!-- Check if the movie has already been displayed -->
            
                @foreach($similarMovie->genres as $genre)
                    @if($movie->genres->contains('id', $genre->id))
                        <h1 class="text-center text-50 text-3xl font-bold font-inter pt-[60px] ">{{ $movie->name }}</h1>

                        <!-- Movie display -->
                        <div class="flex justify-center mb-20">
                            <div class="bg-nav mt-6 rounded-md shadow-2xl md:w-[1100px]">

                                <!-- Here is where Trailer and Image is displayed -->
                                <div class="flex flex-row justify-between">

                                    <!-- Img for movie -->
                                    <div>
                                        <img class="h-[200px] w-[100px] rounded-lg md:rounded-t-lg md:h-[450px] md:w-[280px] shadow-xl" src="{{ $movie->poster }}" alt="{{$movie->name}}">
                                    </div>
                            
                                    <!-- Trailer for movie -->
                                    <div class="col-span-2 md:pl-8 md:pt-4 flex justify-center">
                                        <iframe class="h-[120px] w-1/2 rounded-lg md:h-[420px] md:w-auto" src="{{ $movie->trailer }}" alt="{{ $movie->name }}" data-id="{{$similarMovie->id ?? $movie->id}}"></iframe>
                                    </div>

                                </div>

                                <!-- Grid so that they is side by side on bigger screens -->
                                <div class="md:grid md:grid-cols-2">
                                    <div class="md:w-full">

                                        <!-- Text description on movie -->
                                        <div class="flex justify-center mt-4 md:justify-start md:bg-backgc md:w-[500px] md:mt-10">
                                            <p class="text-center text-50 text-xs font-inter pl-6 pr-6 font-medium md:text-lg md:m-4">{{ $movie->description }}</p>
                                        </div>

                                        <section class="bg-sky-600 mt-4 md:w-[500px] md:bg-nav">
                                            <!-- Genre, Time, Year and Rating -->
                                        
                                                <div class="grid grid-cols-3 gap-2 p-2">
                                                    @foreach($movie->genres as $genre)
                                                        <div class="text-center text-xs text-50 font-inter mt-4 mb-2 md:text-base md:mt-10"> {{$genre['name']}}</div>
                                                    @endforeach
                                                </div>
                                            
                                        
                                            <div class="text-xs text-50 font-inter flex justify-center md:text-base">{{ $movie->release }} | {{ $movie->runtime }} | {{ $movie->rating}}
                                                <img class="h-4 w-auto md:h-8" src="{{ asset('/images/astro-like-removebg.png') }}" alt="Rating logo">
                                            </div>

                                            <!-- buttons for add to watchlist, create new list, rating, share movie, Cast and Find more movies like this -->
                                            <div class="grid grid-cols-3 gap-2 p-6 md:grid-cols-4">
                                                <x-primary-button>
                                                    <a href=" {{ route('login') }}">Watchlist +</a>
                                                </x-primary-button>
                                                <x-primary-button>List +</x-primary-button>
                                                <x-primary-button class="flex justify-center">
                                                    <x-dropdown width="48">
                                                        <x-slot name="trigger">
                                                            <div>
                                                            <img class="h-8 w-auto md:h-14 md:w-auto" src="{{ asset('/images/astro-like-removebg.png') }}" alt="Rating logo">
                                                            </div>
                                                        </x-slot>
                                                        <x-slot name="content">
                                                            <x-dropdown-link href="{{ route('ratings.create') }} ">
                                                                {{ __('Rating') }}
                                                            </x-dropdown-link>
                                                            <x-dropdown-link href="{{ route('reviews.create') }} ">
                                                                {{ __('Review') }}
                                                            </x-dropdown-link>
                                                        </x-slot>
                                                    </x-dropdown>
                                                </x-primary-button>
                                                <x-primary-button><i class="fa-solid fa-share-nodes fa-xl" style="color: #f0f9ff;"></i></x-primary-button>
                                                <x-primary-button class="md:hidden">
                                                    <a href="{{ route('actors') }}">Cast</a>
                                                </x-primary-button>
                                                <x-primary-button class="md:hidden">
                                                    <a href="{{ route('genres.randomDashboard') }}">More like this</a>
                                                </x-primary-button>
                                            </div>
                                        </section>
                                        
                                    </div>

                                    <div class="md:w-full">
                                        <!-- Top 3 cast -->
                                        <div class="md:flex">
                                            <section class="md:bg-backgc rounded-lg md:w-[450px] md:mt-10">
                                                    <p class="text-center text-50 font-inter font-medium mt-4 md:text-base">Top cast</p>
                                                    <div class="grid grid-cols-3 gap-2 p-2">
                                                        @foreach($movie->actors as $actor)
                                                            <div class="pl-1">
                                                                <img class="h-[100px] w-[100px] rounded-full border-solid border-2 border-400 md:h-[180px] md:w-[180px]" src="{{ $actor->profile_pcture }}" alt="{{$actor->name}}">
                                                                <p class="text-center text-50 text-xs font-medium font-inter pt-2 md:text-base">{{ $actor->name }} <br> <span class="text-xs font-light md:text-sm md:font-light">{{$actor->role}}</span></p>
                                                            </div>
                                                        
                                                        @endforeach
                                                    </div>
                                            </section>
                                        </div>
                                    </div>

                                    <div>
                                        <!-- Directors and Writers -->
                                        <section class="mt-10 border-t-[20px] border-sky-600 md:bg-backgc md:border-none md:w-[500px] md:mb-8 md:mt-0">
                                            @foreach($movie->directors as $director)
                                                <p class="text-50 font-medium ml-1 mr-1 border-b-2 border-50 md:text-base">Director - <span class="text-xs font-light md:text-base">{{$director->name}}</span></p>
                                            @endforeach
                                            @foreach($movie->writers as $writer)
                                                <p class="text-50 font-medium ml-1 md:text-base">Writers - <br><span class="text-xs font-light md:text-base md:font-light">{{$writer->name}}</span></p>
                                            @endforeach
                                        </section>

                                        <!-- Reviews -->
                                        <section class="hidden md:contents">
                                            <div  class="md:bg-backgc md:w-[500px] md:pb-1">

                                                    <div class="flex">
                                                        <img class="h-12 w-auto" src="{{ asset('/images/astro-like-removebg.png') }}" alt="Rating logo">
                                                        <p class="text-50 font-inter font-medium mt-2 md:text-base">User reviews</p>

                                                    </div>
                                                    <!-- review from costumer -->
                                                    @if(empty($similarMovie->review))
                                                        <p class="text-sky-50 ml-2 font-medium pt-2 md:text-xl">Be the first to review {{ $movie->name }}</p>  
                                                    @else
                                                        @foreach($movie->reviews as $review)
                                                            <div class="bg-sky-600 rounded-lg flex ml-16 mr-2 mb-4 ">
                                                                        <p class="text-50 text-xs font-inter ml-2">
                                                                        <img src="" alt="Profil bild" class="rounded-lg w-auto h-10 border-solid border-4 border-sky-400 mt-2 md:text-base">Joseph
                                                                        </p>

                                                                    <div class="bg-sky-300/50 rounded-r-lg ml-2 ">
                                                                        <div class=" flex">
                                                                            <img class="h-8 w-auto" src="{{ asset('/images/astro-like-removebg.png') }}" alt="Rating logo">
                                                                        <p class=" text-50 font-inter font-medium pt-1"> 10/10</p>
                                                                        </div>
                                                                        
                                                                        <p class="text-xs text-50 font-inter p-2 md:text-sm">{{ $review->review }}</p>
                                                                    </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                            </div>
                                        </section>
                                    </div>

                                        <!-- More movies like this -->
                                    <section class="md:flex">
                                        @foreach($movie->genres as $genre)
                                        
                                            <div class="pb-4 md:bg-backgc rounded-lg md:w-[450px] md:mb-8">
                                                <p class="text-center text-50 font-inter font-medium mt-4 border-t-[20px] border-sky-600 md:border-none md:text-base">More like this</p>

                                                    <div class="grid grid-cols-3 gap-2 p-2 md:p-4">
                                                    @foreach($similarMovies->take(3) as $similarMovie)
                                                        <div>
                                                                <a href="{{ route('movie.show', ['id' => $similarMovie->id]) }}">
                                                                    <img class="h-[200px] w-auto rounded-lg border-solid border-4 border-sky-800/50 ml-2" src="{{ $similarMovie->poster }}" alt="{{ $similarMovie->name }}">
                                                                </a>
                                                        </div>
                                                    @endforeach
                                                    @break
                                                    </div>

                                            </div>
                                            
                                        @endforeach
                                    </section>




                                </div>
                                    <!-- Reviews (this one is hidden on bigger screens-->
                                
                                        <section class="border-t-[20px] border-b-[20px] border-sky-600 rounded-b-md md:hidden">
                                        
                                                <div class="flex">
                                                    <img class="h-12 w-auto" src="{{ asset('/images/astro-like-removebg.png') }}" alt="Rating logo">
                                                    <p class="text-50 font-inter font-medium mt-2">User reviews</p>
                                                </div>

                                                <!-- review from costumer -->
                                                @if(empty($similarMovie->review))
                                                <p class="text-sky-50 ml-2 font-medium pt-2 md:text-xl">No Reviews on {{ $movie->name }} yet</p>
                                                @else
                                                    @foreach($movie->reviews as $review)
                                                        <div class="bg-sky-600 rounded-lg flex ml-16 mr-2 mb-4">
                                                                    <!-- <p class="text-50 text-xs font-inter ml-2">
                                                                    <img src="{{ asset('/images/profil.jpg') }}" alt="Profil bild" class="rounded-lg w-auto h-10 border-solid border-4 border-sky-400 mt-2">Joseph
                                                                    </p> -->

                                                                <div class="bg-sky-300/50 rounded-r-lg ml-2">
                                                                    <div class=" flex">
                                                                        <img class="h-8 w-auto" src="{{ asset('/images/astro-like-removebg.png') }}" alt="Rating logo">
                                                                    <p class=" text-50 font-inter font-medium pt-1"> 10/10</p>
                                                                    </div>
                                                                    
                                                                    <p class="text-xs text-50 font-inter p-2 ">{{ $review->review }}</p>
                                                                </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                        </section>

                            </div>
                        </div>

                    @endif
                @endforeach

        @break

        @php
            $displayedMovies->push($similarMovie->id ?? $movie->id); // Add the movie ID to the collection of displayed movies
        @endphp
        @endif
 
    @endforeach
@endsection
</x-app-layout>


@else
<x-guest-layout>
@include('layouts.nav')
    <!-- Title -->
    @foreach($similarMovies as $similarMovie)
        @if(!$displayedMovies->contains($similarMovie->id ?? $movie->id)) <!-- Check if the movie has already been displayed -->
            
                @foreach($similarMovie->genres as $genre)
                    @if($movie->genres->contains('id', $genre->id))
                        <h1 class="text-center text-50 text-3xl font-bold font-inter pt-[60px] ">{{ $movie->name }}</h1>

                        <!-- Movie display -->
                        <div class="flex justify-center mb-20">
                            <div class="bg-nav mt-6 rounded-md shadow-2xl md:w-[1100px]">

                                <!-- Here is where Trailer and Image is displayed -->
                                <div class="grid grid-cols-3 gap-2 pt-2 pl-2 pr-2 md:pl-0 md:pt-0">

                                    <!-- Img for movie -->
                                    <div class="col-span-1">
                                        <img class="h-[120px] w-auto rounded-lg md:rounded-t-lg md:h-[450px] shadow-xl" src="{{ $movie->poster }}" alt="{{$movie->name}}">
                                    </div>
                            
                                    <!-- Trailer for movie -->
                                    <div class="col-span-2 md:pl-8 md:pt-4 flex justify-center">
                                        <iframe class="h-[120px] w-1/2 rounded-lg md:h-[400px] md:w-auto" src="{{ $movie->trailer }}" alt="{{ $movie->name }}" data-id="{{$similarMovie->id ?? $movie->id}}"></iframe>
                                    </div>

                                </div>

                                <!-- Grid so that they is side by side on bigger screens -->
                                <div class="md:grid md:grid-cols-2">
                                    <div class="md:w-full">

                                        <!-- Text description on movie -->
                                        <div class="flex justify-center mt-4 md:justify-start md:bg-backgc md:w-[500px] md:mt-10">
                                            <p class="text-center text-50 text-xs font-inter pl-6 pr-6 font-medium md:text-lg md:m-4">{{ $movie->description }}</p>
                                        </div>

                                        <section class="bg-sky-600 mt-4 md:w-[500px] md:bg-nav">
                                            <!-- Genre, Time, Year and Rating -->
                                        
                                                <div class="grid grid-cols-3 gap-2 p-2">
                                                    @foreach($movie->genres as $genre)
                                                        <div class="text-center text-xs text-50 font-inter mt-4 mb-2 md:text-base md:mt-10"> {{$genre['name']}}</div>
                                                    @endforeach
                                                </div>
                                            
                                        
                                            <div class="text-xs text-50 font-inter flex justify-center md:text-base">{{ $movie->release }} | {{ $movie->runtime }} | {{ $movie->rating}}
                                                <img class="h-4 w-auto md:h-8" src="{{ asset('/images/astro-like-removebg.png') }}" alt="Rating logo">
                                            </div>

                                            <!-- buttons for add to watchlist, create new list, rating, share movie, Cast and Find more movies like this -->
                                            <div class="grid grid-cols-3 gap-2 p-6 md:grid-cols-4">
                                                <x-primary-button>
                                                    <a href=" {{ route('login') }}">Watchlist +</a>
                                                </x-primary-button>
                                                <x-primary-button>
                                                    <a href="{{ route('login') }}">List +</a>
                                                </x-primary-button>
                                                <x-primary-button class="flex justify-center">
                                                    <a href="{{ route('login') }}">   
                                                        <img class="h-8 w-auto md:h-14 md:w-auto" src="{{ asset('/images/astro-like-removebg.png') }}" alt="Rating logo">
                                                    </a>
                                                </x-primary-button>
                                                <x-primary-button><i class="fa-solid fa-share-nodes fa-xl" style="color: #f0f9ff;"></i></x-primary-button>
                                                <x-primary-button class="md:hidden">
                                                    <a href="{{ route('actors') }}">Cast</a>
                                                </x-primary-button>
                                                <x-primary-button class="md:hidden">
                                                    <a href="{{ route('genres.randomDashboard') }}">More like this</a>
                                                </x-primary-button>
                                            </div>
                                        </section>
                                        
                                    </div>

                                    <div class="md:w-full">
                                        <!-- Top 3 cast -->
                                        <div class="md:flex">
                                            <section class="md:bg-backgc rounded-lg md:w-[450px] md:mt-10">
                                                    <p class="text-center text-50 font-inter font-medium mt-4 md:text-base">Top cast</p>
                                                    <div class="grid grid-cols-3 gap-2 p-2">
                                                        @foreach($movie->actors as $actor)
                                                            <div class="pl-1">
                                                                <img class="h-[100px] w-[100px] rounded-full border-solid border-2 border-400 md:h-[180px] md:w-[180px]" src="{{ $actor->profile_pcture }}" alt="{{$actor->name}}">
                                                                <p class="text-center text-50 text-xs font-medium font-inter pt-2 md:text-base">{{ $actor->name }} <br> <span class="text-xs font-light md:text-sm md:font-light">{{$actor->role}}</span></p>
                                                            </div>
                                                        
                                                        @endforeach
                                                    </div>
                                            </section>
                                        </div>
                                    </div>

                                    <div>
                                        <!-- Directors and Writers -->
                                        <section class="mt-10 border-t-[20px] border-sky-600 md:bg-backgc md:border-none md:w-[500px] md:mb-8 md:mt-0">
                                            @foreach($movie->directors as $director)
                                                <p class="text-50 font-medium ml-1 mr-1 border-b-2 border-50 md:text-base">Director - <span class="text-xs font-light md:text-base">{{$director->name}}</span></p>
                                            @endforeach
                                            @foreach($movie->writers as $writer)
                                                <p class="text-50 font-medium ml-1 md:text-base">Writers - <br><span class="text-xs font-light md:text-base md:font-light">{{$writer->name}}</span></p>
                                            @endforeach
                                        </section>

                                        <!-- Reviews -->
                                        <section class="hidden md:contents">
                                            <div  class="md:bg-backgc md:w-[500px] md:pb-1">

                                                    <div class="flex">
                                                        <img class="h-12 w-auto" src="{{ asset('/images/astro-like-removebg.png') }}" alt="Rating logo">
                                                        <p class="text-50 font-inter font-medium mt-2 md:text-base">User reviews</p>

                                                    </div>
                                                    <!-- review from costumer -->
                                                    @if(empty($movie->reviews))
                                                        <p class="text-sky-50 ml-2 font-medium pt-2 md:text-xl">Be the first to review {{ $movie->name }}</p>
                                                    @else
                                                        @foreach($movie->reviews as $review)
                                                            <div class="bg-sky-600 rounded-lg flex ml-16 mr-2 mb-4 ">
                                                                        <!-- <p class="text-50 text-xs font-inter ml-2">
                                                                        <img src="" alt="Profil bild" class="rounded-lg w-auto h-10 border-solid border-4 border-sky-400 mt-2 md:text-base">{{$review->name}}
                                                                        </p> -->

                                                                    <div class="bg-sky-300/50 rounded-r-lg ml-2 ">
                                                                        <div class=" flex">
                                                                            <img class="h-8 w-auto" src="{{ asset('/images/astro-like-removebg.png') }}" alt="Rating logo">
                                                                        <p class=" text-50 font-inter font-medium pt-1"> 10/10</p>
                                                                        </div>
                                                                        
                                                                        <p class="text-xs text-50 font-inter p-2 md:text-sm">{{ $review->review }}</p>
                                                                    </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                            </div>
                                        </section>
                                    </div>

                                        <!-- More movies like this -->
                                    <section class="md:flex">
                                        @foreach($movie->genres as $genre)
                                        
                                            <div class="pb-4 md:bg-backgc rounded-lg md:w-[450px] md:mb-8">
                                                <p class="text-center text-50 font-inter font-medium mt-4 border-t-[20px] border-sky-600 md:border-none md:text-base">More like this</p>

                                                    <div class="grid grid-cols-3 gap-2 p-2 md:p-4">
                                                    @foreach($similarMovies->take(3) as $similarMovie)
                                                        <div>
                                                                <a href="{{ route('movie.show', ['id' => $similarMovie->id]) }}">
                                                                    <img class="h-[200px] w-auto rounded-lg border-solid border-4 border-sky-800/50 ml-2" src="{{ $similarMovie->poster }}" alt="{{ $similarMovie->name }}">
                                                                </a>
                                                        </div>
                                                    @endforeach
                                                    @break
                                                    </div>

                                            </div>
                                            
                                        @endforeach
                                    </section>




                                </div>
                                    <!-- Reviews (this one is hidden on bigger screens -->
                                
                                        <section class="border-t-[20px] border-b-[20px] border-sky-600 rounded-b-md md:hidden">
                                        
                                                <div class="flex">
                                                    <img class="h-12 w-auto" src="{{ asset('/images/astro-like-removebg.png') }}" alt="Rating logo">
                                                    <p class="text-50 font-inter font-medium mt-2">User reviews</p>
                                                </div>
                                                @if(empty($similarMovie->review))
                                                <p class="text-sky-50 ml-2 font-medium pt-2 md:text-xl">Be the first to review {{ $movie->name }}</p>
                                                @else
                                                 <!-- review from costumer -->
                                                    @foreach($movie->reviews as $review)
                                                        <div class="bg-sky-600 rounded-lg flex ml-16 mr-2 mb-4">
                                                                    <!-- <p class="text-50 text-xs font-inter ml-2">
                                                                    <img src="{{ $review->profile_picture }}" alt="Profil bild" class="rounded-lg w-auto h-10 border-solid border-4 border-sky-400 mt-2">{{$review->user_name}}
                                                                    </p> -->

                                                                <div class="bg-sky-300/50 rounded-r-lg ml-2">
                                                                    <div class=" flex">
                                                                        <img class="h-8 w-auto" src="{{ asset('/images/astro-like-removebg.png') }}" alt="Rating logo">
                                                                    <p class=" text-50 font-inter font-medium pt-1"> 10/10</p>
                                                                    </div>
                                                                    
                                                                    <p class="text-xs text-50 font-inter p-2 ">{{ $review->review }}</p>
                                                                </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                        </section>

                        

                            </div>
                        </div>

                    @endif
                @endforeach

            @break

        @php
            $displayedMovies->push($similarMovie->id ?? $movie->id); // Add the movie ID to the collection of displayed movies
        @endphp
        @endif
 
    @endforeach

 
</x-guest-layout>
@include('layouts.footer')
@endif
