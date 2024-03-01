<x-app-layout>
    @section('content')

    @if($genre)
        <h1 class="text-center">{{ $genre->name }} Content</h1>
    @elseif($watchlist)
        <h1 class="text-center">Watchlist Content</h1>
    @elseif($userlist)
        <h1 class="text-center">User List Content</h1>
    @endif
    
    <div class="bg-sky-700 mb-8 mt-8 border-solid border-y-4 border-sky-800/50 md:rounded-lg">
        <div>
            <a href="{{ route('genres.show', ['id' => $genre['id']]) }}"> 
                <h2 class="text-sky-50 ml-2 font-medium pt-2 md:text-2xl text-center">{{ $genre['name'] }}</h2>
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
    @endsection
</x-app-layout>
