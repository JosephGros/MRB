@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4 bg-sky-950 text-white mt-10">
    <div class="py-8">

        <!-- Profil info -->
        <div class="max-w-4xl mx-auto bg-sky-800 bg-opacity-75 rounded overflow-hidden shadow-lg ">
            <div class="flex flex-col md:flex-row justify-between items-center text-center md:text-left p-5">
                <!-- Vänster sida med bild och Edit-knapp -->
                <div class="flex-shrink-0 mb-4 md:mb-0 text-center">
                    <img src="{{ asset('/images/profileimage.png') }}" alt="Profile image" id="profileImage" class="w-20 h-20 sm:w-24 sm:h-24 md:w-32 md:h-32 lg:w-34 lg:h-34 xl:w-36 xl:h-36 rounded-full border-4 border-blue-300 object-cover mb-2 mx-auto">
                    <button class="bg-blue-500 text-white rounded-full px-6 py-3 text-base" onclick="document.getElementById('imageInput').click();">Edit</button>
                    
                    <!-- Dolt filinput-element -->
                    <input type="file" id="imageInput" style="display: none;" onchange="previewImage();" accept="image/*">
                </div>
                <!-- Höger sida med detaljer -->
                <div class="flex-grow text-white"> 
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

                    <!-- Knappar -->
                    <div class="flex flex-wrap justify-center md:justify-start space-x-0 md:space-x-3 mt-3">
                        <button class="bg-blue-600 hover:bg-blue-700 px-2 sm:px-4 py-1 sm:py-2 rounded mb-2 md:mb-0">Account settings</button>
                        <button class="bg-green-500 hover:bg-green-600 px-2 sm:px-4 py-1 sm:py-2 rounded mb-2 md:mb-0">New list +</button>
                        <button class="bg-red-600 hover:bg-red-700 px-2 sm:px-4 py-1 sm:py-2 rounded mb-2 md:mb-0">Delete account</button>
                        <button class="bg-blue-600 hover:bg-blue-700 px-2 sm:px-4 py-1 sm:py-2 rounded mb-2 md:mb-0">Logout</button>
                    </div>
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
