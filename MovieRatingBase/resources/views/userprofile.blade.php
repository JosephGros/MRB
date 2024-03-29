@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4 bg-sky-950 text-white mt-10">
    <div class="py-8">

        <!-- Profile info -->
        <div class="max-w-4xl mx-auto bg-sky-800 bg-opacity-75 rounded overflow-hidden shadow-lg ">
            <div class="flex flex-col md:flex-row justify-between items-center text-center md:text-left p-5">
                <!-- Left site with img and edit button -->
                <div class="flex-shrink-0 mb-4 md:mb-0 text-center">
                    <img src="{{ asset('/profile_picture/.png') }}" alt="Profile image" id="profileImage" class="w-20 h-20 sm:w-24 sm:h-24 md:w-32 md:h-32 lg:w-34 lg:h-34 xl:w-36 xl:h-36 rounded-full border-4 border-blue-300 object-cover mb-2 mx-auto">
                    <button class="bg-blue-500 text-white rounded-full px-6 py-3 text-base" onclick="openModal();">Edit</button>

                    <div id="imageModal" class="hidden fixed z-50 left-0 top-0 w-full h-full overflow-auto bg-black bg-opacity-40">
                        <!-- Modal content -->
                        <div class="modal-content bg-sky-750 rounded-lg shadow-lg p-5 m-20">
                            <span class="close cursor-pointer float-right text-gray-700 px-3 py-1 text-xl font-bold" onclick="closeModal()">&times;</span>
                            <div class="flex flex-wrap justify-around p-5">
                                @for ($i = 1; $i <= 10; $i++) <img src="{{ asset('profile_picture/profile' . $i . '.png') }}" alt="Image {{ $i }}" class="w-24 h-24 rounded-full m-2 cursor-pointer" onclick="updateProfileImage('{{ asset('profile_picture/profile' . $i . '.png') }}')">
                                    @endfor
                            </div>
                        </div>
                    </div>
                    <!-- Hidden input field -->
                    <input type="file" id="imageInput" style="display: none;" onchange="previewImage();" accept="image/*">
                </div>
                <!-- Right side -->
                <div class="flex-grow text-white pl-5">
                    <div class="mb-3">
                        <div class="text-lg font-bold">
                            <h3>Username:</h3>
                        </div>
                        <p>{{ Auth::user()->username }}</p>
                    </div>
                    <div class="mb-3">
                        <div class="text-lg font-bold">
                            <h3>Email:</h3>
                        </div>
                        <p>{{ Auth::user()->email }}</p>
                    </div>
                    <div class="mb-3">
                        <div class="text-lg font-bold">
                            <h3>Member since:</h3>
                        </div>
                        <p>{{ Auth::user()->created_at->format('d - m - Y') }}</p>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex flex-wrap justify-center md:justify-start space-x-0 md:space-x-3 mt-3">

                    <a href="{{ route('profile.edit') }}" class="inline-block">

                        <x-button-dark class="px-2 sm:px-4 py-1 sm:py-2 rounded mb-2 md:mb-0">Account settings</x-button-dark>
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-button-dark :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-button-dark>
                    </form>

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

            function openModal() {
                document.getElementById('imageModal').classList.remove('hidden');
            }

            function closeModal() {
                document.getElementById('imageModal').classList.add('hidden');
            }

            function updateProfileImage(imageSrc) {
                // Uppdatera profilbilden i gränssnittet
                document.getElementById('profileImage').src = imageSrc;
                closeModal();

                // Skicka den valda bildens sökväg till servern
                fetch('{{ route("profile.updatePicture") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF-token behövs för POST-requests i Laravel
                        },
                        body: JSON.stringify({
                            imagePath: imageSrc
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Success:', data);
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                    });
            }
        </script>

        @endsection