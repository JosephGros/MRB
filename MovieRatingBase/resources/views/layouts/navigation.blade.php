<script src="https://kit.fontawesome.com/a0315d2788.js" crossorigin="anonymous"></script>

<nav x-data="{ open: false }" class="text-50 font-bold text-xl w-screen">

    <!-- Primary Navigation Menu -->
    <div class="py-4 lg:py-6 md:text-base">
        <div class="flex justify-center h-12 sm:h-16">
            <div class="font-inter text-50 font-bold text-xl">


                <div class="flex items-center py-2 sm:py-6 fixed top-1 left-0 sm:right-0 mt-2 ml-3 sm:ml-0 font-inter">

                    <!-- Logo -->
                    <div class="ml-[130px] sm:ml-8">
                        <a href="#">
                            <img class="h-10 w-30 md:h-20 md:w-40" src="{{ asset('/images/LogoMRB.png') }}" alt="MRB logo">
                        </a>
                    </div>

                    <!-- Navigation Links -->

                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <ul class="hidden sm:-my-px sm:flex items-center mx-auto">
                            <li class="ml-10 list-none">
                                <a href="{{ route('dashboard') }}"  class="hover:text-gray-300">Home</a> <!-- Movies -->
                            </li>
                            <li class="ml-10">
                            <a href="{{ route('user.profile') }}" class="hover:text-gray-300">Profile</a>
                            </li>
                            <li class="ml-10">
                                <a href="{{ route('about-us') }}" class="hover:text-gray-300">About us</a>
                            </li>
                            <li class="ml-10">
                                <a href="{{ route('contact.index') }}" class="hover:text-gray-300">Contact</a>
                            </li>


                            <li class="ml-10">
                                <input type="text" class="ml-10 bg-200 rounded-md text-el w-64 px-4 pl-4 py-1
                            focus:outline-none focus:shadow-outline text-black fa-solid font-inter" placeholder="&#xf002; Search">
                            </li>
                        </ul>
                    </x-nav-link>
                </div>

                <!-- Settings Dropdown -->
                <div class="fixed flex top-0 right-0 sm:p-6 text-right z-10 mt-3 sm:mt-3">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 text-xl leading-4 hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <div class="text-50">{{ Auth::user()->name }}</div>

                                <div class="ms-3">
                                    <img src="{{ asset('/images/profil.jpg') }}" alt="Profil bild" class="rounded-lg w-auto h-12 border-solid border-4 border-sky-600">
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <x-dropdown-link>
                                {{ __('Home') }}
                            </x-dropdown-link>
                            <x-dropdown-link>
                                {{ __('About us') }}
                            </x-dropdown-link>
                            <x-dropdown-link>
                                {{ __('Contact') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>



                <!-- Hamburger -->
                <div class="sm:hidden fixed top-0 left-0 mt-5">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md dark:text-50 dark:hover:text-gray-300 bg-nav focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Search button -->
                <div class="sm:hidden fixed top-0 left-0 ml-14 mt-5">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md dark:text-50 dark:hover:text-gray-300 bg-nav focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                        <svg class="h-6 w-7" xmlns="http://www.w3.org/2000/svg" stroke="currentColor" fill="currentColor" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
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
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1 text-50">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link>
                    {{ __('Home') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link>
                    {{ __('About us') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link>
                    {{ __('Contact') }}
                </x-responsive-nav-link>


                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>

</nav>