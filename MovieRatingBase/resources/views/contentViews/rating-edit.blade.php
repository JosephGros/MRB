<x-app-layout>
    @section('content')

            @if(session('success'))
                <div class="alert alert-success bg-emerald-500 rounded-lg overflow-hidden shadow-sm p-2">
                    <h2>{{ session('success') }}</h2>
                </div>
            @endif
        <div class="flex justify-center item-center mb-[155px]">
            <div class="bg-nav p-8 md:m-20 md:w-[800px] md:h-auto rounded-lg">
                <h1 class="text-center text-50 text-2xl font-bold my-10">Rating</h1>
                <div class="dropdown flex justify-center">

                    <div class="dropdown-menu" aria-labelledby="rateReviewButton">

                        <!-- Rating Form -->
                        <form class="dropdown-item" action="{{ route('ratings.store') }}" method="POST">
                            @csrf
                            <!-- Movie Dropdown -->
                            <div class="mt-6">
                                <x-input-label for="movie_id" :value="__('Movie:')" />
                                    <select name="movie_id" id="movie_id" class="form-control block mt-1 w-full rounded-lg text-blue-500" required>
                                        @foreach ($movies as $movie)
                                            <option value="{{ $movie->id }}">{{ $movie->name }}</option>
                                        @endforeach
                                    </select>
                                <x-input-error :messages="$errors->get('movie_id')" class="mt-2" />
                            </div>'
                            
                            <div class="form-group ml-6">
                                <label for="rating" class="text-50">Rating:</label>
                                <input type="number" class="form-control block" id="rating" name="rating" min="1" max="10" required>
                            </div>

                            <div class="flex justify-center my-8">
                                <x-primary-button type="submit" class="btn btn-primary">Submit Rating</x-primary-button>
                            </div>
                            
                        </form>
                    </div>
                </div>
                
            </div>
        </div>

    @endsection

</x-app-layout>


