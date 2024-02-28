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
                        <x-button-dark class="px-2 sm:px-4 py-1 sm:py-2 rounded mb-2 md:mb-0">Account settings</x-button-dark>
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

            <div>
                <h2 class="text-2xl font-bold mb-4">Watchlist</h2>
                <div class=" bg-sky-700 bg-opacity-75 rounded-md px-5 py-5 flex flex-row flex-wrap justify-start items-center gap-4 overflow-x-auto">
                    <div class="w-1/6 flex-none">
                        <img src="{{ asset('/images/lotr.jpg') }}" alt="Lord of the rings - The return of the king" class="rounded-lg w-full">
                        <span class="block text-center mt-2">Lord of the rings</span>
                    </div>

                    <div class="px-2 w-1/6">
                        <img src="{{ asset('/images/thg.jpg') }}" alt="The Hunger Games - The Ballad of Songbirds and Snakes" class="rounded-lg w-full">
                        <span class="block text-center mt-2">The Hunger Games</span>
                    </div>

                    <div class="px-2 w-1/6">
                        <img src="{{ asset('/images/oppenheimer.jpg') }}" alt="Oppenheimer" class="rounded-lg w-full">
                        <span class="block text-center mt-2">Oppenheimer</span>
                    </div>

                    <div class="px-2 w-1/6">
                        <img src="{{ asset('/images/deadpool.jpg') }}" alt="Deadpool" class="rounded-lg w-full">
                        <span class="block text-center mt-2">Deadpool</span>
                    </div>

                    <div class="px-2 w-1/6">
                        <img src="{{ asset('/images/insideOut.jpg') }}" alt="InsideOut" class="rounded-lg w-full">
                        <span class="block text-center mt-2">InsideOut</span>
                    </div>
                </div>
            </div>


            <!-- Seen Section -->
            <h2 class="text-2xl font-bold mb-4">Seen</h2>
            <div class=" bg-sky-700 bg-opacity-75 rounded-md px-5 py-5 flex flex-row flex-wrap justify-start items-center gap-4 overflow-x-auto">
                <div class="w-1/6 flex-none">
                    <img src="{{ asset('/images/overTheHedge.jpg') }}" alt="Over The Hedge" class="rounded-lg w-full">
                    <span class="block text-center mt-2">Over The Hedge</span>
                </div>

                <div class="w-1/6 flex-none">
                        <img src="{{ asset('/images/spidermanNoWayHome.jpg') }}" alt="Spiderman  No way home" class="rounded-lg w-full">
                        <span class="block text-center mt-2">Spiderman  No way home</span>
                    </div>

                    <div class="w-1/6 flex-none">
                        <img src="{{ asset('/images/spiderman3.jpg') }}" alt="Spiderman3" class="rounded-lg w-full">
                        <span class="block text-center mt-2">Spiderman  3</span>
                    </div>

                    <div class="w-1/6 flex-none">
                        <img src="{{ asset('/images/insideOut1.jpg') }}" alt="Inside Out" class="rounded-lg w-full">
                        <span class="block text-center mt-2">Inside Out</span>
                    </div>


            </div>
             <!-- Favorite Section -->
             <h2 class="text-2xl font-bold mb-4">Favorite</h2>
            <div class="bg-sky-700 bg-opacity-75 rounded-md px-5 py-5 flex flex-row flex-wrap justify-start items-center gap-4 overflow-x-auto">
                <div class="w-1/6 flex-none">
                    <img src="{{ asset('/images/overTheHedge.jpg') }}" alt="Over The Hedge" class="rounded-lg w-full">
                    <span class="block text-center mt-2">Over The Hedge</span>
                </div>

                <div class="w-1/6 flex-none">
                        <img src="{{ asset('/images/spidermanNoWayHome.jpg') }}" alt="Spiderman  No way home" class="rounded-lg w-full">
                        <span class="block text-center mt-2">Spiderman  No way home</span>
                    </div>

                    <div class="w-1/6 flex-none">
                        <img src="{{ asset('/images/spiderman3.jpg') }}" alt="Spiderman3" class="rounded-lg w-full">
                        <span class="block text-center mt-2">Spiderman  3</span>
                    </div>

                    <div class="w-1/6 flex-none">
                        <img src="{{ asset('/images/insideOut1.jpg') }}" alt="Inside Out" class="rounded-lg w-full">
                        <span class="block text-center mt-2">Inside Out</span>
                    </div>
                    <div class="w-1/6 flex-none">
                        <img src="{{ asset('/images/lotr.jpg') }}" alt="Lord of the rings - The return of the king" class="rounded-lg w-full">
                        <span class="block text-center mt-2">Lord of the rings</span>
                    </div>

                    <div class="px-2 w-1/6">
                        <img src="{{ asset('/images/thg.jpg') }}" alt="The Hunger Games - The Ballad of Songbirds and Snakes" class="rounded-lg w-full">
                        <span class="block text-center mt-2">The Hunger Games</span>
                    </div>

                    <div class="px-2 w-1/6">
                        <img src="{{ asset('/images/oppenheimer.jpg') }}" alt="Oppenheimer" class="rounded-lg w-full">
                        <span class="block text-center mt-2">Oppenheimer</span>
                    </div>

                    <div class="px-2 w-1/6">
                        <img src="{{ asset('/images/deadpool.jpg') }}" alt="Deadpool" class="rounded-lg w-full">
                        <span class="block text-center mt-2">Deadpool</span>
                    </div>


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
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            document.getElementById('profileImage').src = "{{ asset('/images/profileimage.png') }}";
        }
    }
</script>

@endsection

