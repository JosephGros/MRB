@extends('layouts.app')

@section('content')
<div class="bg-sky-950 min-h-screen flex flex-col items-center justify-center px-2">
    <!---Image-->
    <div class="w-32 h-32 md:w-48 md:h-48 lg:w-64 lg:h-64 rounded overflow-hidden">
        <img src="{{ asset('/images/LogoMRB.png')}}" alt="logo" class="w-full h-full ">
    </div>
    <div class="flex items-center justify-center space-x-4 mb-4 py-2">
        <h1 class="text-[53px] font-extrabold text-sky-50">Contact us</h1>
    </div>

       
 <div class="bg-sky-800 text-white p-8 rounded-lg shadow-lg w-full max-w-xs">
        
        <form action="{{ route('contact.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="name" class="block text-sm font-semibold text-sky-50">Name</label>
                <input type="text" id="name" name="name" class="w-full p-2 rounded-md bg-white border border-blue focus:border-blue-500 focus:outline-none text-black" placeholder="First and last name" required>
            </div>
            <div>
                <label for="email" class="block text-sm font-semibold text-sky-50">Email</label>
                <input type="email" id="email" name="email" class="w-full p-2 rounded-md bg-white border border-blue focus:border-blue-500 focus:outline-none text-black" placeholder="Your email here..." required>
            </div>
            <div>
                <label for="message" class="block text-sm font-semibold text-sky-50">Description</label>
                <textarea id="message" name="message" rows="4" class="w-full p-2 rounded-md bg-white border border-blue focus:border-blue-500 focus:outline-none text-black" placeholder="Enter your message here..." required></textarea>
            </div>
            <button type="submit" class="items-center bg-sky-950 p-3 rounded-md hover:bg-sky-700 transition-colors">Send</button>
        </form>
    </div>
</div>


    </div>

   
@endsection