<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-center">
            <h1 class="text-4xl font-bold text-sky-50">@if(isset($movie)) Edit Movie @else Add New Movie @endif</h1>
        </div>
    </x-slot>

@section('content')

@if(session('error'))
    <div class="alert alert-danger">
        <h2>{{ session('error') }}</h2>
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">
        <h2>{{ session('success') }}</h2>
    </div>
@endif
    <div class="py-8 w-full">
        <div class="w-4/5 mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center content-center bg-sky-700 sm:rounded-lg overflow-hidden shadow-sm">
                <div class="w-4/5">
                    <form method="post" 
                            action="{{ isset($movie) ? route('movies.update', $movie->id) : route('movies.store') }}" 
                            enctype="multipart/form-data" 
                            class="space-y-4 px-6 py-4">
                            @csrf 
                            @if(isset($movie))
                                @method('PUT')
                            @endif
                        <div>
                            <label for="name" class="block text-sky-50 font-semibold text-base ">Title</label>
                            <input type="text" name="name" id="name" value="{{ isset($movie) ? $movie->name : '' }}" class="block mt-1 w-full border-sky-900 shadow-sm rounded-md sm:text-sm focus:ring-sky-500 focus:border-sky-500">
                        </div>
                        <div>
                            <label for="poster" class="block text-sky-50 font-semibold text-base ">Poster</label>
                            <input type="file" name="poster" id="poster" class="block mt-1 w-full border-sky-900 shadow-sm rounded-md sm:text-sm focus:ring-sky-500 focus:border-sky-500">
                        </div>
                        <div>
                            <label for="release" class="block text-sky-50 font-semibold text-base ">Release Date</label>
                            <input type="text" name="release" id="release" value="{{ isset($movie) ? $movie->release : '' }}" class="block mt-1 w-full border-sky-900 shadow-sm rounded-md sm:text-sm focus:ring-sky-500 focus:border-sky-500">
                        </div>
                        <div>
                            <label for="runtime" class="block text-sky-50 font-semibold text-base ">Runtime</label>
                            <input type="text" name="runtime" id="runtime" value="{{ isset($movie) ? $movie->runtime : '' }}" class="block mt-1 w-full border-sky-900 shadow-sm rounded-md sm:text-sm focus:ring-sky-500 focus:border-sky-500">
                        </div>
                        <div>
                            <label for="description" class="block text-sky-50 font-semibold text-base ">Description</label>
                            <textarea name="description" id="description" class="block mt-1 w-full border-sky-900 shadow-sm rounded-md sm:text-sm focus:ring-sky-500 focus:border-sky-500">{{ isset($movie) ? $movie->description : '' }}</textarea>
                        </div>
                        <div>
                            <label for="trailer" class="block text-sky-50 font-semibold text-base ">Trailer</label>
                            <input type="text" name="trailer" id="trailer" value="{{ isset($movie) ? $movie->trailer : '' }}" class="block mt-1 w-full border-sky-900 shadow-sm rounded-md sm:text-sm focus:ring-sky-500 focus:border-sky-500">
                        </div>
                        <div>
                            <label for="actors" class="block text-sky-50 font-semibold text-base">Actors</label>
                            <select name="actors[]" id="actors" multiple class="block mt-1 w-full border-sky-900 shadow-sm rounded-md sm:text-sm focus:ring-sky-500 focus:border-sky-500">
                                @foreach($actors as $actor)
                                    <option value="{{ $actor->id }}">{{ $actor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="selectedActors">Selected Actors:</label>
                            <ul id="selectedActorsList"></ul>
                        </div>
                        <div>
                            <label for="genres" class="block text-sky-50 font-semibold text-base">Genres</label>
                            <select name="genres[]" id="genres" multiple class="block mt-1 w-full border-sky-900 shadow-sm rounded-md sm:text-sm focus:ring-sky-500 focus:border-sky-500">
                                @foreach($genres as $genre)
                                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="selectedGenres">Selected Genres:</label>
                            <ul id="selectedGenresList"></ul>
                        </div>

                            <button type="submit" class="bg-sky-500 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>

        document.addEventListener('DOMContentLoaded', function() {
            const actorsDropdown = document.getElementById('actors');
            const selectedActors = document.getElementById('selectedActorsList');

            actorsDropdown.addEventListener('channge', function() {
                const selected = Array.from(this.selected);

                selectedActors.innerHTML = '';

                selected.forEach(option => {
                    const actorId = option.value;
                    const actorName = option.text;

                    const listItem = document.createElement('li');
                    listItem.textContent = actorName;
                })
            })
        })

//         <!-- let currentPage = 'editMovies';

//         if(currentPage !== 'editMovies'){
//             currentPage = 'editSeries';
//         }

//         document.getElementById('search-results').addEventListener('click', function(event) {
//             let target = event.target;
//             if (target && target.matches('li.search-result-item')) {
//                 let resultType = target.dataset.resultType;
//                 let resultId = target.dataset.resultId;
                
                

//                 if (currentPage === 'editMovies' || currentPage === 'editSeries') {
//                     switch (resultType) {
//                         case 'actors':
//                             addActor(resultId);
//                             break;
//                         case 'genres':
//                         case 'directors':
//                         case 'creators':
//                         case 'writers':
//                             addEntity(resultType, resultId);
//                             break;
//                         default:
//                             break;
//                     }
//                 } else {
//                     if (resultType === 'movies') {
//                         window.location.href = '/movies/' + resultId;
//                     } else if (resultType === 'series') {
//                         window.location.href = '/series/' + resultId;
//                     }
//                 }
//             }
//         });

//         function addEntity(entityType, entityId){
//     let selectedEntities = document.getElementById('selected-' + entityType);

//     let entityName = target.textContent;
//     let entityItem = document.createElement('div');
//     entityItem.innerHTML = `
//         <div class="font-semibold">${entityName}</div>
//         <input type="hidden" name="${entityType}[]" value="${entityId}" class="'block', 'mt-1', 'w-full', 'border-sky-900', 'shadow-sm', 'rounded-md', 'sm:text-sm', 'focus:ring-sky-500', 'focus:border-sky-500'">
//     `;

//     selectedEntities.appendChild(entityItem);
// }

// function addActor(actorId){

//     let actorName = document.querySelector(`[data-result-id="${actorId}"]`).textContent;

//     let selectedActors = document.getElementById('selected-actors');

//     let actorTitle = document.createElement('div');
//     actorTitle.classList.add('border', 'active:border-sky-900', 'p-3', 'rounded-md', 'mb-2', 'cursor-pointer')

//     let actorRole = document.createElement('input');
//     actorRole.type = 'text';
//     actorRole.placeholder = 'Enter role...';
//     actorRole.classList.add('block', 'mt-1', 'w-full', 'border-sky-900', 'shadow-sm', 'rounded-md', 'sm:text-sm', 'focus:ring-sky-500', 'focus:border-sky-500');
//     actorRole.dataset.actorId = actorId;

//     actorTitle.innerHTML = `<div class="block text-sky-50 font-semibold text-base cursor-pointer">${actorName}</div>`;

//     actorTitle.appendChild(actorRole)

//     selectedActors.appendChild(actorTitle);

// } -->
    </script>

@endsection
</x-admin-layout>
