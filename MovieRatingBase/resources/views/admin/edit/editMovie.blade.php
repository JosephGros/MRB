<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-center">
            <h1 class="text-4xl font-bold text-sky-50">{{ @if(isset($movie)) Edit Movie @else Add New Movie @endif }}</h1>
        </div>
    </x-slot>

@section('content')
    <div class="py-8 w-full">
        <div class="w-4/5 mx-auto sm:px-6 lg:px-8">
            <div class="bg-sky-700 sm:rounded-lg overflow-hidden shadow-sm">
                <form @if(isset(@movie)) action="{{ route('movies.update', $movie->id) }}" @else method="post" enctype="multipart/form-data" class="space-y-4 px-6 py-4">
                    @csrf 
                    @if(isset(@movie)) @method('PUT') @endif
                    <div>
                        <label for="name" class="block text-sky-50 font-semibold text-base ">Title</label>
                        <input type="text" name="name" id="name" class="block mt-1 w-full border-sky-900 shadow-sm rounded-md sm:text-sm focus:ring-sky-500 focus:border-sky-500">
                    </div>
                    <div>
                        <label for="poster" class="block text-sky-50 font-semibold text-base ">Poster</label>
                        <input type="file" name="poster" id="poster" value="{{ old('name', isset(@movie) ? @movie->name : '') }}" class="block mt-1 w-full border-sky-900 shadow-sm rounded-md sm:text-sm focus:ring-sky-500 focus:border-sky-500">
                    </div>
                    <div>
                        <label for="release" class="block text-sky-50 font-semibold text-base ">Release Date</label>
                        <input type="text" name="release" id="release" value="{{ old('release', isset(@movie) ? @movie->release : '') }}" class="block mt-1 w-full border-sky-900 shadow-sm rounded-md sm:text-sm focus:ring-sky-500 focus:border-sky-500">
                    </div>
                    <div>
                        <label for="runtime" class="block text-sky-50 font-semibold text-base ">Runtime</label>
                        <input type="text" name="runtime" id="runtime" value="{{ old('runtime', isset(@movie) ? @movie->runtime : '') }}" class="block mt-1 w-full border-sky-900 shadow-sm rounded-md sm:text-sm focus:ring-sky-500 focus:border-sky-500">
                    </div>
                    <div>
                        <label for="description" class="block text-sky-50 font-semibold text-base ">Description</label>
                        <textarea name="description" id="description" class="block mt-1 w-full border-sky-900 shadow-sm rounded-md sm:text-sm focus:ring-sky-500 focus:border-sky-500">
                            {{ old('description', isset(@movie) ? @movie->description : '') }}
                        </textarea>
                    </div>
                    <div>
                        <label for="trailer" class="block text-sky-50 font-semibold text-base ">Trailer</label>
                        <input type="text" name="trailer" id="trailer" value="{{ old('trailer', isset(@movie) ? @movie->trailer : '') }}" class="block mt-1 w-full border-sky-900 shadow-sm rounded-md sm:text-sm focus:ring-sky-500 focus:border-sky-500">
                    </div>

                    <div>
                        <label for="actors" class="block text-sky-50 font-semibold text-base ">Actors</label>
                        @foreach(@actors as @actor)
                            <div>
                                <input type="text" name="trailer" id="trailer" value="{{ old('trailer', isset(@movie) ? @movie->trailer : '') }}" class="block mt-1 w-full border-sky-900 shadow-sm rounded-md sm:text-sm focus:ring-sky-500 focus:border-sky-500">
                            </div>
                        @endforeach
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
    

@endsection
</x-admin-layout>
