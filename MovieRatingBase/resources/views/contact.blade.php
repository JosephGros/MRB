@extends('layouts.app')

@section('content')
<div class="bg-sky-950 min-h-screen flex justify-center items-center">
    <div class="flex flex-col lg:flex-row items-center justify-center gap-10 p-4">
        
        <!-- Contact Form & Logo -->
        <div class=" bg-opacity-75 bg-sky-800 p-8 rounded-lg shadow-lg w-full lg:w-1/2 max-w-md">
            <div class="text-center">
                <img src="{{ asset('/images/LogoMRB.png') }}" alt="logo" class="mb-6 w-50 h-50 ">
                <h2 class="text-4xl text-sky-950 font-bold mb-6">Contact us</h2>
            </div>
            <form action="{{ route('contact.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="text-lg mb-2 block">Name</label>
                    <input type="text" id="name" name="name" placeholder="First and last name" class="w-full p-4 rounded-md border-2 border-sky-200 ">
                </div>
                <div class="mb-4">
                    <label for="email" class="text-lg mb-2 block">Email</label>
                    <input type="email" id="email" name="email" placeholder="Your email here..." class="w-full p-4 rounded-md border-2 border-sky-200">
                </div>
                <div class="mb-8">
                    <label for="message" class="text-lg mb-2 block">Description</label>
                    <textarea id="message" name="message" rows="4" placeholder="Enter your message here..." class="w-full p-4 rounded-md border-2 border-sky-200"></textarea>
                </div>
                <button type="submit" class="bg-sky-600 text-white p-4 rounded-lg w-full">Send Message</button>
            </form>
        </div>

        <!-- Right Section for Contact Image and Text -->
        <div class="w-full lg:w-1/2 flex flex-col items-center lg:items-start">
            <div class="w-full max-w-md">
                <img src="{{ asset('/images/contact-us.webp') }}" alt="Contact Us" class="rounded-lg shadow-lg mb-4">
                <h2 class="text-xl lg:text-2xl text-sky-50 font-semibold mb-4 shadow-md p-4 bg-opacity-35 bg-sky-800 rounded-lg border border-sky-900 w-full">
                    Reach out to us at MRB for expert solutions tailored to your needs. Our dedicated team is ready to assist with any inquiries, offer advice, or discuss collaborative opportunities to enhance your business.
                </h2>
            </div>
        </div>

    </div>
</div>
@endsection