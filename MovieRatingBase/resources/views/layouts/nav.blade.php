<script src="https://kit.fontawesome.com/a0315d2788.js" crossorigin="anonymous"></script>

<nav x-data="{ open: false }" class="bg-nav text-50 font-bold text-xl static w-screen">
       
    <!-- Navigation not logged in -->
    <div class="max-w-7xl mx-auto py-4 lg:py-6 px-4 sm:px-6 text-sm md:text-base">
            <div class="flex justify-center h-12 sm:h-16">
                <div class="text-50 font-bold text-xl static">

                            <!-- Login / create account -->
                            @if (Route::has('login'))
                            <div class="fixed flex top-0 right-0 p-2 sm:p-6 text-right z-10 mt-2 sm:mt-3">
                                @auth
                                <a href="{{ url('/dashboard') }}" class="font-bold font-inter hover:text-gray-300  focus:outline focus:outline-2 focus:rounded-sm"></a>
                                @else
                                <a href="{{ route('login') }}" class="ml-4 font-semibold dark:hover:text-gray-300 h-10 w-10 mt-2 rounded-lg border-solid border-4 border-sky-600"><svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 bg-sky-600" stroke="sky-600" fill="#082f49" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path  d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/>
                                    </svg></a>

                                @if (Route::has('register'))
                                <a href="{{ route('register') }}">
                                </a>
                                @endif
                                @endauth
                            </div>
                            @endif


                            <!-- Navigation  -->
                                <div class="flex items-center py-2 sm:py-6 fixed top-1 left-0 sm:right-0 mt-2 ml-3 sm:ml-0 font-inter">

                                    <!-- Logo -->
                                    <div class="ml-[130px] sm:ml-8">
                                        <a href="#">
                                            <img class="h-10 w-30 md:h-20 md:w-40" src="{{ Vite::asset('images/LogoMRB.png') }}" alt="MRB logo">
                                        </a>
                                    </div>

                                    <!-- Navigation Links -->
                                    <ul class="hidden sm:-my-px sm:ms-10 sm:flex items-center mx-auto">
                                        <li class="ml-10 list-none">
                                            <a href="#" class="hover:text-gray-300">Home</a> <!-- Movies -->
                                        </li>
                                        <li class="ml-10">
                                            <a href="#" class="hover:text-gray-300">Profile</a>
                                        </li>
                                        <li class="ml-10">
                                            <a href="#" class="hover:text-gray-300">About us</a>
                                        </li>
                                        <li class="ml-10">
                                            <a href="#" class="hover:text-gray-300">Contact</a>
                                        </li>

                                        <li class="ml-10 sm:ml-6">
                                            <x-text-input type="text" class="ml-10 bg-200 rounded-md text-sm sm:text-xl w-64 px-4 pl-4 py-1
                                            focus:outline-none focus:shadow-outline text-black fa-solid font-inter" placeholder="&#xf002; Search">
                                            </x-text-input>
                                        </li>
                                    </ul>
                                </div> 


                            <!-- Hamburger -->
                            <div class="sm:hidden fixed top-0 left-0 mt-4">
                                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md dark:text-50 dark:hover:text-gray-300 bg-nav focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                                    <svg class="h-8 w-8" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Search button -->
                            <div class="sm:hidden fixed top-0 left-0 ml-14 mt-5">
                                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md dark:text-50 dark:hover:text-gray-300 bg-nav focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                                    <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" stroke="currentColor" fill="currentColor" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/>
                                    <!-- <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /> -->
                                    </svg>
                                </button>
                            </div>
                        
                </div>
            </div> 
    </div>


    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">

                <div class="mt-3 space-y-1 text-50">
                    <a>
                        {{ __('Profile') }}
                    </a>
                    <x-responsive-nav-link>
                        {{ __('Home') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link>
                        {{ __('About us') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link>
                        {{ __('Contact') }}
                    </x-responsive-nav-link>

                </div>
        </div>
    </div>
</nav>
