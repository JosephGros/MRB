
<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4 bg-nav" :status="session('status')" />
    <h1 class="text-center text-2xl mb-10 font-medium pt-4">Sign in</h1>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-6 flex justify-between items-center">

        <x-input-label for="password" :value="__('Password')" />

            @if (Route::has('password.request'))
                <a class="underline text-sm text-right text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

        </div>
            <x-text-input id="password" stroke="sky-50" class="fill:block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />

        <!-- Sign in button -->
        <div class="flex items-center justify-end mt-6 mb-10 shadow-xl">
            <button class="block mt-1 w-full text-center bg-600 text-50 font-inter font-medium rounded-md p-2 hover:bg-sky-400">
                {{ __('Sign in') }}
            </button>
        </div>

        <div class="inline-flex items-center justify-center w-full">
            <hr class="w-20 md:w-32 h-px my-8 bg-black border-0 dark:bg-black">
            <span class="text-center font-inter px-4 font-medium line-clamp-1">New to MRB?</span>
            <hr class="w-20 md:w-32 h-px my-8 bg-black border-0 dark:bg-back">
        </div>
    </form>
            <!-- Create account button -->
            <div class="flex items-center justify-end mt-10 mb-12 shadow-xl">
            <a href="{{ route('register') }}" class="block mt-1 w-full text-center bg-50 text-backgc font-inter font-bold rounded-md p-2 hover:bg-sky-400">
                    {{ __('Create your MRB account') }}
            </a>
        </div>
</x-guest-layout>



