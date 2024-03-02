<x-app-layout>
    <style>
        .scrollbar-thin {
            scrollbar-width: thin;
        }
        .scrollbar-thumb-sky-800 {
            scrollbar-color: #2b6cb0 #e5e7eb;
        }
        .scrollbar-thumb-sky-800:hover {
            background-color: #2c5282;
        }
        .scrollbar-track-sky-700 {
            background: #cbd5e0;
        }
    </style>
    @section('content')
        @foreach($latestInGenre as $genre)

                    <div class="bg-sky-700 mb-8 mt-8 border-solid border-y-4 border-sky-800/50 md:rounded-lg">

                        <div>

                        <a href="{{ route('genres.show', ['id' => $genre['id']]) }}">
                            <h2 class="text-sky-50 ml-2 font-medium pt-2 md:text-2xl">{{ $genre['name'] }}</h2>
                        </a>

                            <div class="overflow-x-auto whitespace-nowrap py-4 px-2 md:px-4 scrollbar-thin scrollbar-thumb-sky-800 scrollbar-track-sky-700">

                                    @foreach($genre['items'] as $key => $item)

                                        <div class="inline-block w-[50%] md:w-[25%] lg:w-[20%] xl:w-[15%] h-auto p-4">

                                            <div class="relative h-[250px] w-[175px]">
                                            <img class="w-[175px] h-[250px] rounded-lg border-solid border-4 border-sky-800/50 object-fit" src="{{ $item->poster }}" alt="{{ $item->name }}">
                                            @if(Auth::user()->watchlist->contains($item))
                                            <form method="POST" action="{{ route('watchlist.destroy', $item->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="absolute inset-x-0 bottom-0 h-8 bg-blue-500 text-white p-2 rounded hover:bg-blue-800 m-1">
                                                    Watchlist X
                                                </button>
                                            </form>
                                            @else
                                            <form method="POST" action="{{ route('watchlist.store', $item->id) }}">
                                                @csrf
                                                <button type="submit" class="absolute inset-x-0 bottom-0 h-8 bg-blue-500 text-white p-2 rounded hover:bg-blue-800 m-1">
                                                    Watchlist +
                                                </button>
                                            </form>
                                            @endif
                                            </div>

                                        </div>

                                    @endforeach

                            </div>

                            </div>

                        </div>

                    </div>

            @endforeach
    @endsection
</x-app-layout>