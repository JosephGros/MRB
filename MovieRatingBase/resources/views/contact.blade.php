@extends('layouts.app')

@section('content')
<div class="bg-sky-950 min-h-screen flex flex-col items-center justify-center">
    <!---Image-->
    <div class="w-32 h-32 md:w-48 md:h-48 lg:w-64 lg:h-64 rounded overflow-hidden ">
        <img src="{{ asset('/images/LogoMRB.png')}}" alt="logo" class="w-full h-full py-5">
    </div>

    <div class="flex items-center justify-center space-x-4 mb-4 py-2">
        <h1 class="text-[53px] font-extrabold text-sky-50">Contact us</h1>
    </div>


    <div class="bg-sky-800 text-white p-8 rounded-lg shadow-lg w-full max-w-xs">

        <form action="{{ route('contact.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="name" class="block text-sm font-semibold text-sky-50 text-[23px] pb-5 text-center">Name</label>
                <input type="text" id="name" name="name" class="w-full p-2 rounded-md bg-white border border-blue focus:border-blue-500 focus:outline-none text-black" placeholder="First and last name" required>
            </div>
            <div>
                <label for="email" class="block text-sm font-semibold text-sky-50 text-[23px] pb-5 text-center">Email</label>
                <input type="email" id="email" name="email" class="w-full p-2 rounded-md bg-white border border-blue focus:border-blue-500 focus:outline-none text-black" placeholder="Your email here..." required>
            </div>
            <div>
                <label for="message" class="block text-sm font-semibold text-sky-50 text-[23px] pb-5 text-center">Description</label>
                <textarea id="message" name="message" rows="4" class="w-full p-2 rounded-md bg-white border border-blue focus:border-blue-500 focus:outline-none text-black" placeholder="Enter your message here..." required></textarea>
            </div>
            <div class="flex justify-center">

                <button type="submit" class="bg-sky-950 p-3 rounded-md hover:bg-sky-700 transition-colors">Send</button>
            </div>
            <!---Image-->
            <div class="w-42 h-42 md:w-58 md:h-58 lg:w-64 lg:h-64 rounded-md overflow-hidden">
                <img src="{{ asset('/images/contact-us.webp')}}" alt="logo" class="w-full h-full ">
            </div>
        </form>
    </div>
</div>

</div>


@endsection