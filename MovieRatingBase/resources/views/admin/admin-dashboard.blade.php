<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-center">
            <h1 class="text-4xl font-bold text-sky-50">Admin Dashboard</h1>
        </div>
    </x-slot>

@section('content')
    <div class="max-w-2xl flex flex-wrap justify-evenly content-center place-content-evenly bg-300 rounded-xl p-3 ">
        <div class="w-96 flex flex-wrap justify-evenly content-center">
            <x-admin-choice>
                <a href="{{ route('admin.index', ['type' => 'movies']) }}">Manage Movies</a>
            </x-admin-choice>
            <x-admin-choice>
                <a href="{{ route('admin.index', ['type' => 'series']) }}">Manage Series</a>
            </x-admin-choice>
            <x-admin-choice>
                <a href="{{ route('admin.index', ['type' => 'genres']) }}">Manage Genres</a>
            </x-admin-choice>
            <x-admin-choice>
                <a href="{{ route('admin.index', ['type' => 'actors']) }}">Manage Actors</a>
            </x-admin-choice>
            <x-admin-choice>
                <a href="{{ route('admin.index', ['type' => 'directors']) }}">Manage Directors</a>
            </x-admin-choice>
            <x-admin-choice>
                <a href="{{ route('admin.index', ['type' => 'creators']) }}">Manage Creators</a>
            </x-admin-choice>
            <x-admin-choice>
                <a href="{{ route('admin.index', ['type' => 'writers']) }}">Manage Writers</a>
            </x-admin-choice>
            <x-admin-choice>
                <a href="{{ route('admin.index', ['type' => 'reviews']) }}">Manage Reviews</a>
            </x-admin-choice>

            @if(Auth::user()->role === 0)
                <x-admin-choice>
                    <a href="{{ route('admin.users.all', ['type' => 'users']) }}">Manage Users</a>
                </x-admin-choice>
            @endif
        </div>
    </div>
@endsection
</x-admin-layout>
