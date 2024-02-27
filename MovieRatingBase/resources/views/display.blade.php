@vite(['resources/css/app.css'])
<script src="https://kit.fontawesome.com/a0315d2788.js" crossorigin="anonymous"></script>

@include('layouts.nav')
<!-- <div name="display"> -->

<x-guest-layout>
    <!-- Title -->
    <h1 class="text-center text-50 text-3xl font-bold font-inter pt-[60px] ">Lord of The Rings</h1>
    <h2 class="text-center text-50 font-inter">The return of the king</h2>

    <!-- Movie display -->
    <div class="flex justify-center mb-20">
        <div class="bg-nav mt-6 rounded-md shadow-2xl md:w-[1100px]">

            <!-- Here is where Trailer and Image is displayed -->
            <div class="grid grid-cols-3 gap-2 pt-2 pl-2 pr-2 md:pl-0 md:pt-0">

                <!-- Img for movie -->
                <div class="col-span-1">
                    <img class="h-[120px] w-auto rounded-lg md:rounded-t-lg md:h-[450px] shadow-xl" src="{{ asset('/images/lotr3.jpg') }}" alt="Lord of the rings 3">
                </div>
        
                <!-- Trailer for movie -->
                <div class="col-span-2 md:pl-8 md:pt-4">
                    <img class="h-[120px] w-auto rounded-lg md:h-[400px]" src="{{ asset('/images/lotr3-1.jpg') }}" alt="Lord of the rings 3">
                </div>

            </div>

            <!-- Grid so that they is side by side on bigger screens -->
            <div class="md:grid md:grid-cols-2">
                <div class="md:w-full">

                    <!-- Text description on movie -->
                    <div class="flex justify-center mt-4 md:justify-start md:bg-backgc md:w-[500px] md:mt-10">
                        <p class="text-center text-50 text-xs font-inter pl-6 pr-6 font-medium md:text-lg md:m-4">Gandalf and Aragorn lead the World of Men against Sauron's army to draw his gaze from Frodo and Sam as they approach Mount Doom with the One Ring.</p>
                    </div>

                    <section class="bg-sky-600 mt-4 md:w-[500px] md:bg-nav">
                        <!-- Genre, Time, Year and Rating -->
                        <div class="text-center text-xs text-50 font-inter mt-4 mb-2 md:text-base md:mt-10">Action | Adventure | Drama</div>
                        <div class="text-xs text-50 font-inter flex justify-center md:text-base">2003 | 3h 21m | 9.0/10 
                            <img class="h-4 w-auto md:h-8" src="{{ asset('/images/astro-like-removebg.png') }}" alt="Rating logo">
                        </div>

                        <!-- buttons for add to watchlist, create new list, rating, share movie, Cast and Find more movies like this -->
                        <div class="grid grid-cols-3 gap-2 p-6 md:grid-cols-4">
                            <x-primary-button>Watchlist +</x-primary-button>
                            <x-primary-button>List +</x-primary-button>
                            <x-primary-button class="flex justify-center"><img class="h-8 w-auto md:h-14 md:w-auto" src="{{ asset('/images/astro-like-removebg.png') }}" alt="Rating logo"></x-primary-button>
                            <x-primary-button><i class="fa-solid fa-share-nodes fa-xl" style="color: #f0f9ff;"></i></x-primary-button>
                            <x-primary-button class="md:hidden">Cast</x-primary-button>
                            <x-primary-button class="md:hidden">More like this</x-primary-button>
                        </div>
                    </section>
                    
                </div>

                <div class="md:w-full">
                    <!-- Top 3 cast -->
                    <div class="md:flex">
                        <div class="hidden md:contents">
                            <div class="md:mt-[170px] md:mr-2 md:bg-backgc md:text-50 md:rounded-lg md:h-16 md:w-8 md:text-center md:text-4xl md:pt-3"><</div>
                        </div>
                        <section class="md:bg-backgc rounded-lg md:w-[450px] md:mt-10">
                                <p class="text-center text-50 font-inter font-medium mt-4 md:text-base">Top cast</p>
                                <div class="grid grid-cols-3 gap-2 p-2">
                                    <div class="pl-1">
                                        <img class="h-[100px] w-[100px] rounded-full border-solid border-2 border-400 md:h-[180px] md:w-[180px]" src="{{ asset('/images/elijah.jpg') }}" alt="Elijah Wood">
                                        <p class="text-center text-50 text-xs font-medium font-inter pt-2 md:text-base">Elijah Wood <br> <span class="text-xs font-light md:text-sm md:font-light">Frodo</span></p>
                                    </div>
                                    <div class="pl-1">
                                        <img class="h-[100px] w-[100px] rounded-full border-solid border-2 border-400 md:h-[180px] md:w-[180px]" src="{{ asset('/images/ian.jpg') }}" alt="Ian McKellan">
                                        <p class="text-center text-50 text-xs font-medium font-inter pt-2 md:text-base">Ian McKellan <br> <span class="text-xs font-light md:text-sm md:font-light">Gandalf</span></p>
                                    </div>
                                    <div class="pl-1">
                                        <img class="h-[100px] w-[100px] rounded-full border-solid border-2 border-400 md:h-[180px] md:w-[180px]" src="{{ asset('/images/viggo.jpg') }}" alt="Elijah Wood">
                                        <p class="text-center text-50 text-xs font-medium font-inter pt-2 md:text-base">Viggo Mortensen <br> <span class="text-xs font-light md:text-sm md:font-light">Aragon</span></p>
                                    </div>
                                </div>
                        </section>
                        <div class="hidden md:contents">
                            <div class="md:mt-[170px] md:ml-2 md:bg-backgc md:text-50 md:rounded-lg md:h-16 md:w-8 md:text-center md:text-4xl md:pt-3">></div>
                        </div>
                    </div>
                </div>

                <div>
                    <!-- Directors and Writers -->
                    <section class="mt-10 border-t-[20px] border-sky-600 md:bg-backgc md:border-none md:w-[500px] md:mb-8 md:mt-0">
                        <p class="text-50 font-medium ml-1 mr-1 border-b-2 border-50 md:text-base">Director - <span class="text-xs font-light md:text-base">Peter Jackson</span></p>
                        <p class="text-50 font-medium ml-1 md:text-base">Writers - <br><span class="text-xs font-light md:text-base md:font-light">J.R.R Tolkien | Fran Walsh | Philippa Boyens</span></p>
                    </section>

                    <!-- Reviews -->
                    <section class="hidden md:contents">
                        <div  class="md:bg-backgc md:w-[500px] md:pb-1">
                            <div class="flex">
                                <img class="h-12 w-auto" src="{{ asset('/images/astro-like-removebg.png') }}" alt="Rating logo">
                                <p class="text-50 font-inter font-medium mt-2 md:text-base">User reviews</p>

                            </div>
                            <!-- review from costumer -->
                            <div class="bg-sky-600 rounded-lg flex ml-16 mr-2 mb-4 ">
                                        <p class="text-50 text-xs font-inter ml-2">
                                        <img src="{{ asset('/images/profil.jpg') }}" alt="Profil bild" class="rounded-lg w-auto h-10 border-solid border-4 border-sky-400 mt-2 md:text-base">Joseph
                                        </p>

                                    <div class="bg-sky-300/50 rounded-r-lg ml-2 ">
                                        <div class=" flex">
                                            <img class="h-8 w-auto" src="{{ asset('/images/astro-like-removebg.png') }}" alt="Rating logo">
                                        <p class=" text-50 font-inter font-medium pt-1"> 10/10</p>
                                        </div>
                                        
                                        <p class="text-xs text-50 font-inter p-2 md:text-sm">A cinematic triumph, "The Return of the King" is a perfect conclusion to the epic trilogy. 
                                            Stunning visuals, emotional depth, and impeccable performances make it a masterpiece. 
                                            The grand finale delivers on every level, blending intense action with heartfelt moments, 
                                            solidifying its place among the greatest film conclusions.</p>
                                    </div>
                            </div>
                        </div>
                    </section>
                </div>

                <div>
                    <!-- More movies like this -->
                    <div class="md:flex">
                        <div class="hidden md:contents">
                            <div class="md:mt-[170px] md:mr-2 md:bg-backgc md:text-50 md:rounded-lg md:h-16 md:w-8 md:text-center md:text-4xl md:pt-3"><</div>
                        </div>
                        <section class="pb-4 md:bg-backgc rounded-lg md:w-[450px] md:mb-8">
                            <p class="text-center text-50 font-inter font-medium mt-4 border-t-[20px] border-sky-600 md:border-none md:text-base">More like this</p>

                                <div class="grid grid-cols-3 gap-2 p-2 md:p-4">
                                    <div>
                                        <img class="h-[140px] w-auto rounded-lg md:h-[250px] md:w-auto" src="{{ asset('/images/lotr1.jpg') }}" alt="Lord of the rings 1">
                                    </div>
                                    <div>
                                        <img class="h-[140px] w-auto rounded-lg md:h-[250px] md:w-auto" src="{{ asset('/images/lotr2.jpg') }}" alt="Lord of the rings 2">
                                    </div>
                                    <div>
                                        <img class="h-[140px] w-auto rounded-lg md:h-[250px] md:w-auto" src="{{ asset('/images/sw3.jpg') }}" alt="Starwars 3">
                                    </div>

                                </div>

                        </section>
                        <div class="hidden md:contents">
                            <div class="md:mt-[170px] md:ml-2 md:bg-backgc md:text-50 md:rounded-lg md:h-16 md:w-8 md:text-center md:text-4xl md:pt-3">></div>
                        </div>
                    </div>
                </div>
            </div>
            
                <!-- Reviews (this one is hidden on bigger screens-->
                <section class="border-t-[20px] border-b-[20px] border-sky-600 rounded-b-md md:hidden">
                    <div class="flex">
                        <img class="h-12 w-auto" src="{{ asset('/images/astro-like-removebg.png') }}" alt="Rating logo">
                        <p class="text-50 font-inter font-medium mt-2">User reviews</p>

                    </div>
                    <!-- review from costumer -->
                    <div class="bg-sky-600 rounded-lg flex ml-16 mr-2 mb-4">
                                <p class="text-50 text-xs font-inter ml-2">
                                <img src="{{ asset('/images/profil.jpg') }}" alt="Profil bild" class="rounded-lg w-auto h-10 border-solid border-4 border-sky-400 mt-2">Joseph
                                </p>

                            <div class="bg-sky-300/50 rounded-r-lg ml-2">
                                <div class=" flex">
                                    <img class="h-8 w-auto" src="{{ asset('/images/astro-like-removebg.png') }}" alt="Rating logo">
                                <p class=" text-50 font-inter font-medium pt-1"> 10/10</p>
                                </div>
                                
                                <p class="text-xs text-50 font-inter p-2 ">A cinematic triumph, "The Return of the King" is a perfect conclusion to the epic trilogy. 
                                    Stunning visuals, emotional depth, and impeccable performances make it a masterpiece. 
                                    The grand finale delivers on every level, blending intense action with heartfelt moments, 
                                    solidifying its place among the greatest film conclusions.</p>
                            </div>
                    </div>
                </section>



        </div>
    </div>
</x-guest.layout>
<!-- </div> -->

    @include('layouts.footer')
