@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4 bg-gray-900 text-white">
    <!-- Profile Section -->
    <div class="flex justify-between items-center py-8 border-b border-gray-700">
        <!-- Profile Info -->
        <div class="flex items-center">
            <img src="/path/to/profile-image.jpg" alt="profile" class="w-16 h-16 rounded-full mr-4">
            <div>
                <h2 class="text-2xl font-semibold">Joseph</h2>
                <p>wiley.joseph.gros@gmail.com</p>
                <p>Member since 06 - 02 - 2024</p>
            </div>
        </div>
        <!-- Actions -->
        <div>
            <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Account settings</button>
            <button class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2">Logout</button>
        </div>
    </div>

    <!-- Movie Listings -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 py-8">
        <!-- Dynamic movie cards generated with Laravel -->
        <!-- Movie Card Example -->
        
        <div class="bg-gray-800 rounded overflow-hidden shadow-lg transform transition duration-500 hover:scale-105">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">
                <div class="bg-blue-800 rounded-lg shadow-lg overflow-hidden flex items-center p-5">
                    
  <!-- Left side with image -->
  <div class="flex items-start">
    <div class="relative">
      <img src="/path/to/your/profile-image.jpg" alt="Profile image" class="w-32 h-32 rounded-full border-4 border-blue-300">
      <button class="absolute -bottom-2 -right-2 bg-blue-500 text-white rounded-full px-2 py-1 text-xs">Edit</button>
    </div>
  </div>
  <!-- Right side with details -->
  <div class="ml-5 text-white">
    <div class="mb-3">
      <div class="text-lg font-bold">Username</div>
      <div>Joseph</div>
    </div>
    <div class="mb-3">
      <div class="text-lg font-bold">Email</div>
      <div>wiley.joseph.gros@gmail.com</div>
    </div>
    <div class="mb-3">
      <div class="text-lg font-bold">Member since</div>
      <div>06 - 02 - 2024</div>
    </div>
    <!-- Buttons -->
    <div class="flex space-x-3">
      <button class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded">Account settings</button>
      <button class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded">New list +</button>
    </div>
    <div class="flex space-x-3 mt-3">
      <button class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded">Delete account</button>
      <button class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded">Logout</button>
    </div>
  </div>
</div>
                </div>
                <p class="text-gray-400 text-base">
                </p>
            </div>
        </div>
    </div>
</div>

@endsection
