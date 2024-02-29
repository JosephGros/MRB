<x-app-layout>
    @section('content')
    @if($source === 'genre')
    <h1>{{ $genre->name }} Content</h1>
    @elseif($source === 'watchlist')
    <h1>Watchlist Content</h1>
    @elseif($source === 'userlist')
    <h1>User List Content</h1>
    @endif
    <ul>
        @foreach($allContent as $content)
        
        <div class="flex-none w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6">
            <img src="{{ $content->poster}}" alt="Lord of the rings - The return of the king" class="rounded-lg w-full">
            <span class="block text-center mt-2">{{$content->name}}</span>
        </div>
        @endforeach
    </ul>
    @endsection
</x-app-layout>