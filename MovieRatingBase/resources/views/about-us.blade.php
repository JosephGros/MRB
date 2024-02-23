{{-- resources/views/about-us.blade.php --}}
@extends('layouts.app')
@section('content')
<div class="bg-sky-900 min-h-screen w-full flex justify-center items-center">
    <div class="w-full mx-auto py-6 px-6 lg:px-8 sm:w-11/12 md:max-w-7xl">
        <div class="text-center pt-24">
            <h1 class="font-extrabold text-4xl text-white mb-4">
                About us at <img src="{{ asset('/images/LogoMRB.png') }}" alt="Logo" class="inline h-20 md:h-32 md:w-32">
            </h1>
        </div>
        <div class="mt-10 sm:mt-0 bg-sky-700 rounded-lg shadow overflow-hidden">
            <div class="">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h2 class="text-2xl leading-6 text-white text-center mt-2 pt-6">Meet the Team</h2>
                        <p class="text-2xl mt-1 text-white text-center">
                            Learn more about the people behind MRB.
                        </p>
                        <h2 class="text-lg font-medium leading-6 text-white mt-6 text-center">Welcome to MRB (Movie Rating Base), the brainchild of three passionate programmers who share a common love for movies and series. As part of our assignment, we decided to channel our programming skills into creating a dynamic movie rating website application that reflects our enthusiasm for cinematic experiences.</h2>
                    </div>
                </div>

                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <ol class="divide-y divide-gray-200">
                            <li class="px-4 py-4 sm:px-6">
                                <h4 class="text-xl font-medium text-white">Joseph Gros</h4>
                                <p class="text-sm text-white">The Programming Maestro: A shared identity with a shared passion, Joseph is the programming maestro who brings technical brilliance to the forefront. Armed with a keyboard and a collective vision, he transforms lines of code into the backbone of MRB, ensuring a seamless user experience.</p>
                            </li>
                            <li class="px-4 py-4 sm:px-6">
                                <h4 class="text-xl font-medium text-white">Ahmed Almari</h4>
                                <p class="text-sm text-white">The Code Alchemist: With a knack for turning abstract ideas into functional code, Ahmed is the code alchemist behind the scenes. He contributes to the technical wizardry that powers MRB, turning our collective passion into a tangible, user-friendly platform.</p>
                            </li>
                            <li class="px-4 py-4 sm:px-6">
                                <h4 class="text-xl font-medium text-white">Matilda Källström</h4>
                                <p class="text-sm text-white">The Cinematic Code Explorer: As the cinematic code explorer, Matilda delves into the intricacies of programming while maintaining a deep appreciation for movies and series. She ensures that MRB not only functions flawlessly but also reflects the diversity and richness of the cinematic world.</p>
                            </li>
                        </ol>
                        <div class="px-4 py-4 sm:px-6">
                            <h3 class="text-lg text-white text-center">Together, we form the heart and soul of MRB, infusing our shared love for programming and cinematic wonders into every line of code. MRB is not just a platform for movie ratings; it's a testament to our dedication to blending technology with our passion for the silver screen.</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center pt-6">
            <a href="{{ route('contact.index') }}" class="inline-block">
                <button type="button" class="text-white bg-gradient-to-r from-sky-400 via-sky-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                    Contact us
                </button>
            </a>

            <a href="create-account">
                <button type="button" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                </button>

                <button type="button" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                    <a href="Home">Home</a>
                </button>
        </div>
    </div>
</div>
@endsection
