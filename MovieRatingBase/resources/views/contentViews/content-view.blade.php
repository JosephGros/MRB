<x-app-layout>
@section ('content')
        <div>
            <div class="bg-sky-700 mb-8 mt-8 border-solid border-y-4 border-sky-800/50 md:rounded-lg">
                @if(!$media)
                    <a href="{{ route('genres.show', ['id' => $genre['id']]) }}">
                        <h2 class="text-sky-50 ml-2 font-extrabold pt-2 md:text-2xl">{{ $genre['name'] }}</h2>
                    </a>
                    <div id="genreContainer{{ $genre['id'] }}" class="overflow-x-auto whitespace-nowrap mb-4 max-w-full relative" data-carousel="slide">
                        <div id="genreCarousel{{ $genre['id'] }}" class="overflow-x-hidden whitespace-nowrap mb-4 max-w-full relative">
                            <div class="flex">
                                @foreach($allGenreContent as $item)
                                    <div class="inline-block w-[180px] h-[300px] mx-[10px] p-1 flex justify-center items-center">
                                        <div class="relative h-[250px] w-[175px] rounded-lg shadow-md shadow-sky-950">
                                            <a href="{{ route('movie.show', ['id' => $item->id]) }}">
                                                <img class="h-[250px] w-[175px] rounded-lg border-solid border-4 border-sky-800/50 object-cover" src="{{ $item->poster }}" alt="{{ $item->name }}">
                                            </a>
                                            @if(auth()->user()->watchlist->contains('media_id', $item->id))
                                                <form method="POST" action="{{ route('watchlist.destroy', ['id' => $item->id]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="absolute flex items-center justify-center w-[30px] inset-x-0 top-0 h-8 bg-blue-950 rounded hover:bg-blue-800 m-1 bg-opacity-75">
                                                        <span class="material-symbols-outlined text-sky-50">bookmark_added</span>
                                                    </button>
                                                </form>
                                            @else
                                                <form method="POST" action="{{ route('watchlist.store') }}">
                                                    @csrf
                                                    <input type="hidden" name="movie_id" value="{{ $item->id }}">
                                                    <button type="submit" class="absolute flex items-center justify-center w-[30px] inset-x-0 top-0 h-8 bg-blue-950 rounded hover:bg-blue-800 m-1 bg-opacity-75">
                                                        <span class="material-symbols-outlined text-sky-50">bookmark_add</span>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @else
                    <h2 class="text-sky-50 ml-2 font-extrabold pt-2 md:text-2xl">Watchlist</h2>
                    @foreach($media as $item)
                        @if($item)
                            <div class="inline-block w-[180px] h-[300px] mx-[10px] p-1 flex justify-center items-center">
                                <div class="relative h-[250px] w-[175px] rounded-lg shadow-md shadow-sky-950">
                                    <a href="{{ route('movie.show', ['id' => $item->id]) }}">
                                        <img class="h-[250px] w-[175px] rounded-lg border-solid border-4 border-sky-800/50 object-cover" src="{{ $item->poster }}" alt="{{ $item->name }}">
                                    </a>
                                    @if(auth()->user()->watchlist->contains('media_id', $item->id))
                                        <form method="POST" action="{{ route('watchlist.destroy', ['id' => $item->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="absolute flex items-center justify-center w-[30px] inset-x-0 top-0 h-8 bg-blue-950 rounded hover:bg-blue-800 m-1 bg-opacity-75">
                                                <span class="material-symbols-outlined text-sky-50">bookmark_added</span>
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('watchlist.store') }}">
                                            @csrf
                                            <input type="hidden" name="movie_id" value="{{ $item->id }}">
                                            <button type="submit" class="absolute flex items-center justify-center w-[30px] inset-x-0 top-0 h-8 bg-blue-950 rounded hover:bg-blue-800 m-1 bg-opacity-75">
                                                <span class="material-symbols-outlined text-sky-50">bookmark_add</span>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    @endsection
</x-app-layout>