<x-app-layout>
    @section('content')

    @isset($genre)
    <h1 class="text-center">{{ $genre->name }} Content</h1>
    <div class="bg-sky-700 mb-8 mt-8 border-solid border-y-4 border-sky-800/50 md:rounded-lg">
        <div>
            <a href="{{ route('genres.show', ['id' => $genre->id]) }}">
                <h2 class="text-sky-50 ml-2 font-medium pt-2 md:text-2xl text-center">{{ $genre->name }}</h2>
            </a>
            <div class="relative overflow-hidden rounded-lg">
                <div class="flex flex-wrap duration-500 ease-in-out justify-center">
                    @foreach($allGenreContent as $item)
                    <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5 2xl:w-1/6 p-4 text-center">
                        <img class="w-[200px] h-[300px] rounded-lg border-solid border-4 border-sky-800/50 object-cover mx-auto" src="{{ $item->poster }}" alt="{{ $item->name }}">
                        <button class="absolute top-0 bg-blue-500 text-white p-2 rounded hover:bg-blue-800 m-2">+</button>
                        <h3 class="text-sky-50 md:text-base 2xl:text-xl">{{ $item->name }}</h3>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endisset

    @isset($watchlistMedia)
    {{-- Watchlist Content --}}
    <div class="bg-sky-700 mb-8 mt-8 border-solid border-y-4 border-sky-800/50 md:rounded-lg">
        <h2 class="text-center text-2xl font-semibold mb-4">Watchlist Content</h2>
        <div class="flex flex-wrap duration-500 ease-in-out justify-center">
            @foreach($watchlistMedia as $media)
            @if(is_array($media))
            <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5 2xl:w-1/6 p-4 text-center">
                <img src="{{ $media['poster'] }}" alt="{{ $media['title'] }}" class="w-[200px] h-[300px] rounded-lg border-solid border-4 border-sky-800/50 object-cover mx-auto">
                <h3 class="text-xl font-semibold">{{ $media['title'] }}</h3>
                <p class="text-gray-600">Added: {{ $media['added'] ? $media['added']->format('Y-m-d') : 'Unknown' }}</p>
            </div>
            @else
            <div class="bg-white rounded-lg p-4 shadow-md">
                <img src="{{ $media->poster }}" alt="{{ $media->title }}" class="w-full h-48 object-cover mb-4">
                <h3 class="text-xl font-semibold">{{ $media->title }}</h3>
                <p class="text-gray-600">Added: {{ $media->added ? $media->added->format('Y-m-d') : 'Unknown' }}</p>
            </div>
            @endif
            @endforeach

        </div>
    </div>
    @endisset

    @endsection
</x-app-layout>