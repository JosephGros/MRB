<x-app-layout>
    @section('content')

            @if(session('success'))
                <div class="alert alert-success bg-emerald-500 rounded-lg overflow-hidden shadow-sm p-2">
                    <h2>{{ session('success') }}</h2>
                </div>
            @endif
        <div class="flex justify-center item-center mb-[155px]">
            <div class="bg-nav p-8 w-full md:w-1/3 md:m-20 md:h-auto rounded-lg">
                <h1 class="text-center text-50 text-2xl font-bold my-10">Rating</h1>
                <div class="dropdown flex justify-center">

                    <div class="dropdown-menu w-full" aria-labelledby="rateReviewButton">

                        <!-- Rating Form -->
                        <form class="dropdown-item" action="{{ route('ratings.store') }}" method="POST">
                            @csrf
                            <!-- Movie Dropdown -->
                            <div class="mt-6">
                                <x-input-label for="movie_id" :value="__('Movie:')" />
                                    <select name="movie_id" id="movie_id" class="form-control block mt-1 w-full rounded-lg text-sky-950" required>
                                        @foreach ($movies as $movie)
                                            <option value="{{ $movie->id }}">{{ $movie->name }}</option>
                                        @endforeach
                                    </select>
                                <x-input-error :messages="$errors->get('movie_id')" class="mt-2" />
                            </div>'
                            <div class="flex justify-center">
                                <div class="form-group w-1/2">
                                    <label for="rating" class="text-50">Rating:</label>
                                    <input type="number" class="flex justify-center w-full" id="rating" name="rating" min="1" max="10" required>
                                </div>
                            </div>

                            <div class="flex justify-center my-8">
                                <x-button-dark type="submit" class="btn btn-primary w-full">Submit Rating</x-button-dark>
                            </div>
                            
                        </form>
                    </div>
                </div>
                
            </div>
        </div>

    @endsection

</x-app-layout>


