<x-app-layout>
    @section('content')

            @if(session('success'))
                <div class="alert alert-success bg-emerald-500 rounded-lg overflow-hidden shadow-sm p-2">
                    <h2>{{ session('success') }}</h2>
                </div>
            @endif
        <div class="flex justify-center item-center mb-[155px]">
            <div class="bg-nav p-8 md:m-20 md:w-[800px] md:h-auto rounded-lg">
                <h1 class="text-center text-50 text-2xl font-bold my-10">Review</h1>
                <div class="dropdown flex justify-center">

                    <div class="dropdown-menu" aria-labelledby="rateReviewButton">

                        <!-- Review Form -->
                        <form class="dropdown-item" action="{{ route('reviews.store') }}" method="POST">
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
                            
                            <div class="form-group">
                                <label for="review" class="flex flex-cols mb-2 text-50 font-inter">Review:</label>
                                <textarea class="form-control" id="review" name="review" rows="3"></textarea>
                            </div>
                            <div class="flex justify-center">
                                <x-primary-button type="submit" class="btn btn-primary">Submit Review</x-primary-button>
                            </div>
                            
                        </form>
                    </div>
                </div>
                
            </div>
        </div>

    @endsection

</x-app-layout>
