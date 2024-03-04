@extends('layouts.app')
    @section ('content')

    <div>
        <div class="bg-sky-700 mb-8 mt-8 border-solid border-y-4 border-sky-800/50 md:rounded-lg">

            @if(Route::currentRouteName() === 'genres.show')
            <a href="{{ route('genres.show', ['id' => $genre['id']]) }}">
                <h2 class="text-sky-50 ml-2 font-extrabold pt-2 md:text-2xl text-center">{{ $genre['name'] }}</h2>
            </a>
            <div id="genreContainer{{ $genre['id'] }}" class="overflow-x-auto whitespace-nowrap mb-4 max-w-full relative pl-4">
                <div class="flex flex-wrap justify-center mx-[-10px]">
                    @foreach($allGenreContent as $item)
                    <div class="inline-flex flex-col w-[180px] mx-[10px] my-2 p-1 items-center">
                        <div class="relative h-[250px] w-[175px] rounded-lg shadow-md shadow-sky-950 overflow-hidden">
                            <a href="{{ route('movie.show', ['id' => $item->id]) }}">
                                <img class="w-full h-full object-cover rounded-lg border-solid border-4 border-sky-800/50" src="{{ asset($item->poster) }}" alt="{{ $item->name }}">
                            </a>
                            @if(auth()->user()->watchlist->contains('media_id', $item->id))
                            <form method="POST" action="{{ route('watchlist.destroy', ['id' => $item->id]) }}" class="absolute top-0 right-0 m-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="flex items-center justify-center w-[30px] h-8 bg-blue-950 rounded hover:bg-blue-800 bg-opacity-75">
                                    <span class="material-symbols-outlined text-sky-50">bookmark_added</span>
                                </button>
                            </form>
                            @else
                            <form method="POST" action="{{ route('watchlist.store') }}" class="absolute top-0 right-0 m-1">
                                @csrf
                                <input type="hidden" name="movie_id" value="{{ $item->id }}">
                                <button type="submit" class="flex items-center justify-center w-[30px] h-8 bg-blue-950 rounded hover:bg-blue-800 bg-opacity-75">
                                    <span class="material-symbols-outlined text-sky-50">bookmark_add</span>
                                </button>
                            </form>
                            @endif
                        </div>
                        <div class="w-[175px] text-center mt-2">
                            <p class="text-white overflow-hidden text-ellipsis">{{ $item->name }}</p>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
        @elseif(Route::currentRouteName() === 'watchlist.index')
        <h2 class="text-sky-50 ml-2 font-extrabold pt-2 md:text-2xl text-center">Watchlist</h2>
        <div id="watchlistContainer" class="mb-4 max-w-full relative" data-carousel="slide">
            <div id="watchlistCarousel" class="mb-4 max-w-full relative">

                <div class="flex flex-wrap justify-center mx-[-10px]">
                    @foreach($media as $item)

                    <div class="inline-flex flex-col w-[180px] mx-[10px] my-2 p-1 items-center">
                        <div class=" h-[250px] w-[175px] rounded-lg shadow-md shadow-sky-950 overflow-hidden">
                            <a href="{{ route('movie.show', ['id' => $item->id]) }}">
                                <img class="w-full h-full object-cover rounded-lg border-solid border-4 border-sky-800/50" src="{{ asset($item->poster) }}" alt="{{ $item->name }}">

                                @if(auth()->user()->watchlist->contains('media_id', $item->id))
                                <form method="POST" action="{{ route('watchlist.destroy', ['id' => $item->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="absolute flex items-center justify-center w-[30px] inset-x-0 top-0 h-8 bg-blue-950 rounded hover:bg-blue-800 m-1 bg-opacity-75">
                                        <span class="material-symbols-outlined text-sky-50">bookmark_added</span>
                                    </button>
                                </form>
                                @else
                                <form method="POST" action="{{route('watchlist.store') }}">
                                    @csrf
                                    <input type="hidden" name="movie_id" value="{{ $item->id }}">
                                    <button type="submit" class="absolute flex items-center justify-center w-[30px] inset-x-0 top-0 h-8 bg-blue-950 rounded hover:bg-blue-800 m-1 bg-opacity-75">
                                        <span class="material-symbols-outlined text-sky-50">bookmark_add</span>
                                    </button>
                                </form>
                                @endif
                        </div>
                        <div class="w-[175px] text-center mt-2">
                            <p class="text-white overflow-hidden text-ellipsis">{{ $item->name }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>

</div>

@endsection

