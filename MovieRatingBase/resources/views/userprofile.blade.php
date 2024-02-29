@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4 bg-sky-950 text-white mt-10">
    <div class="py-8">

        <!-- Profile info -->
        <div class="max-w-4xl mx-auto bg-sky-800 bg-opacity-75 rounded overflow-hidden shadow-lg ">
            <div class="flex flex-col md:flex-row justify-between items-center text-center md:text-left p-5">
                <!-- Left site with img and edit button -->
                <div class="flex-shrink-0 mb-4 md:mb-0 text-center">
                    <img src="{{ asset('/images/profileimage.png') }}" alt="Profile image" id="profileImage" class="w-20 h-20 sm:w-24 sm:h-24 md:w-32 md:h-32 lg:w-34 lg:h-34 xl:w-36 xl:h-36 rounded-full border-4 border-blue-300 object-cover mb-2 mx-auto">
                    <x-button-dark class="bg-blue-500 text-white rounded-full px-6 py-3 text-base" onclick="document.getElementById('imageInput').click();">Edit</x-button-dark>


                    <!-- Hidden input field -->
                    <input type="file" id="imageInput" style="display: none;" onchange="previewImage();" accept="image/*">
                </div>
                <!-- Right side -->
                <div class="flex-grow text-white pl-5">
                    <div class="mb-3">
                        <div class="text-lg font-bold">
                            <h3>Username:</h3>
                        </div>
                        <p>Joseph</p>
                    </div>
                    <div class="mb-3">
                        <div class="text-lg font-bold">
                            <h3>Email:</h3>
                        </div>
                        <p>wiley.joseph.gros@gmail.com</p>
                    </div>
                    <div class="mb-3">
                        <div class="text-lg font-bold">
                            <h3>Member since:</h3>
                        </div>
                        <p>06 - 02 - 2024</p>
                    </div>

                    <!-- Buttons -->
                    <div class="flex flex-wrap justify-center md:justify-start space-x-0 md:space-x-3 mt-3">

                        <a href="{{ route('profile.edit') }}" class="inline-block">

                            <x-button-dark class="px-2 sm:px-4 py-1 sm:py-2 rounded mb-2 md:mb-0">Account settings</x-button-dark>
                        </a>

                        <x-button-dark class="px-2 sm:px-4 py-1 sm:py-2 rounded mb-2 md:mb-0">New list +</x-button-dark>
                        <x-button-dark class="px-2 sm:px-4 py-1 sm:py-2 rounded mb-2 md:mb-0">Delete account</x-button-dark>
                        <x-button-dark class="px-2 sm:px-4 py-1 sm:py-2 rounded mb-2 md:mb-0">Logout</x-button-dark>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <!--Movie section-->

    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 gap-8">
            <!-- Watchlist Section -->

            <div class="">
                <h2 class="text-2xl font-bold mb-4">Watchlist</h2>
                <div class="relative bg-sky-700 bg-opacity-75 rounded-md">
                    <button class="carousel-button absolute z-30 px-4 cursor-pointer bg-sky-700 bg-opacity-85 text-white shadow-lg hover:bg-sky-600 left-4 transform -translate-y-1/2 top-1/2" data-direction="-1" data-carousel="watchlistCarousel">&#10094;</button>
                    <button class="carousel-button absolute z-30 px-4 cursor-pointer bg-sky-700 bg-opacity-85 text-white shadow-lg hover:bg-sky-600 right-4 transform -translate-y-1/2 top-1/2" data-direction="1" data-carousel="watchlistCarousel">&#10095;</button>
                    <div id="watchlistCarousel" class="flex flex-row justify-start items-center gap-4 overflow-hidden px-5 py-5">

                        @foreach ($limit as $watchList)
                        <div class="flex-none w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6">
                            <img src="{{ $watchList->poster}}" alt="Lord of the rings - The return of the king" class="rounded-lg w-full">
                            <span class="block text-center mt-2">{{$watchList->name}}</span>
                        </div>
                        @endforeach

                    </div>
                </div>

                <div>


                    <!-- Seen Section -->
                    @foreach ($allUserLists as $userList)
                    <h2 class="text-2xl font-bold mb-4">{{$userList['list']->name}}</h2>
                    <div class="relative bg-sky-700 bg-opacity-75 rounded-md">
                        <button class="carousel-button absolute z-30 px-4 cursor-pointer bg-sky-700 bg-opacity-85 text-white shadow-lg hover:bg-sky-600 left-4 transform -translate-y-1/2 top-1/2" data-direction="-1" data-carousel="seenCarousel">&#10094;</button>
                        <button class="carousel-button absolute z-30 px-4 cursor-pointer bg-sky-700 bg-opacity-85 text-white shadow-lg hover:bg-sky-600 right-4 transform -translate-y-1/2 top-1/2" data-direction="1" data-carousel="seenCarousel">&#10095;</button>
                        <div id="seenCarousel" class="flex flex-row justify-start items-center gap-4 overflow-hidden px-5 py-5">
                         
                        
                        @foreach ($userList['content'] as $content)
                            <div class="flex-none w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6">
                                <img src="{{$content->poster}}" alt="Over The Hedge" class="rounded-lg w-full">
                                <span class="block text-center mt-2">{{$content->name}}</span>
                            </div>
                            @endforeach
                            @endforeach
                            


                        </div>
                    </div>

                </div>

            </div>


            <script>
                function previewImage() {
                    var file = document.getElementById('imageInput').files[0];
                    var reader = new FileReader();
                    reader.onloadend = function() {
                        document.getElementById('profileImage').src = reader.result;
                    };
                    if (file) {
                        reader.readAsDataURL(file);
                    } else {
                        document.getElementById('profileImage').src = "{{ asset('/images/profileimage.png') }}";
                    }
                }

                // Specifika scroll-funktioner för varje karusell
                document.addEventListener('DOMContentLoaded', function() {
                    document.querySelectorAll('.carousel-button').forEach(button => {
                        button.addEventListener('click', function() {
                            const carouselId = this.getAttribute('data-carousel');
                            const direction = parseInt(this.getAttribute('data-direction'), 10);
                            scrollCarousel(carouselId, direction);
                        });
                    });
                });

                function scrollCarousel(carouselId, direction) {
                    let container = document.getElementById(carouselId);
                    let scrollAmount = container.clientWidth / 2 * direction;
                    container.scrollBy({
                        left: scrollAmount,
                        behavior: 'smooth'
                    });
                }
            </script>

            @endsection