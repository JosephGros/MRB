{{-- resources/views/about-us.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="bg-sky-800 max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div>
            <div class="text-center pt-24">
                <h1 class="font-extrabold text-4xl text-white mb-4">
                    About us at <img src="{{ asset('/images/LogoMRB.png') }}" alt="Logo" class="inline h-20  md:h-32 md:w-32">
                </h1>
            </div>
        </div>
    </div>

    <div class="mt-10 sm:mt-0 border-4 bg-sky-700">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h2 class="text-lg font-medium leading-6 text-white mt-6 text-center">Welcome to MRB (Movie Rating Base), the brainchild of three passionate programmers who share a common love for movies and series. As part of our assignment, we decided to channel our programming skills into creating a dynamic movie rating website application that reflects our enthusiasm for cinematic experiences.</h2>
                    <h3 class="text-lg leading-6 text-white text-center mt-2">Meet the Team:</h3>
                    <p class="mt-1 text-sm text-white text-center">
                        Learn more about the people behind MRB.
                    </p>
                </div>
            </div>

            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="shadow overflow-hidden sm:rounded-md">
                    {{-- Team Members List --}}
                    <ol class="divide-y divide-gray-200">
                        {{-- Each member is a list item --}}
                        <li class="px-4 py-4 sm:px-6">
                            <h4 class="text-lg font-medium text-white">1. Joseph Gros</h4>
                            <p class="text-sm text-white">The Programming Maestro: A shared identity with a shared passion, Joseph is the programming maestro who brings technical brilliance to the forefront. Armed with a keyboard and a collective vision, he transforms lines of code into the backbone of MRB, ensuring a seamless user experience.</p>
                        </li>
                        <li class="px-4 py-4 sm:px-6">
                            <h4 class="text-lg font-medium text-gray-900">2. Ahmed Almari</h4>
                            <p class="text-sm text-gray-500">The Code Alchemist: With a knack for turning abstract ideas into functional code, Ahmed is the code alchemist behind the scenes. He contributes to the technical wizardry that powers MRB, turning our collective passion into a tangible, user-friendly platform.</p>
                        </li>
                        <li class="px-4 py-4 sm:px-6">
                            <h4 class="text-lg font-medium text-gray-900">3. Matilda Källström</h4>
                            <p class="text-sm text-gray-500">The Cinematic Code Explorer: As the cinematic code explorer, Matilda delves into the intricacies of programming while maintaining a deep appreciation for movies and series. She ensures that MRB not only functions flawlessly but also reflects the diversity and richness of the cinematic world.</p>
                        </li>
                    </ol>
                    <div class="px-4 py-4 sm:px-6">
                        <h3 class="text-lg text-gray-500 text-center">Together, we form
                            the heart and soul of MRB, infusing our shared love for programming and cinematic wonders into every line of code. MRB is not just a platform for movie ratings; it's a testament to our dedication to blending technology with our passion for the silver screen.</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection