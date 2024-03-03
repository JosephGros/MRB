<x-app-layout>
    @section('content')

            @if(session('success'))
                <div class="alert alert-success bg-emerald-500 rounded-lg overflow-hidden shadow-sm p-2">
                    <h2>{{ session('success') }}</h2>
                </div>
            @endif
        <div class="flex justify-center item-center mb-[100px]">
            <div class="bg-nav p-8 md:m-20 md:w-[800px] md:h-auto rounded-lg">
                <h1 class="text-center text-50 text-2xl font-bold my-10">
                    {{ __('Review') }}
                </h1>
                <div class="dropdown flex justify-center">
                    <!-- <button class="btn btn-secondary dropdown-toggle" type="button" id="rateReviewButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Rate & Review
                    </button> -->
                    <div class="dropdown-menu" aria-labelledby="rateReviewButton">
                        <!-- Rating Form -->
                        @isset($review)
                            <form method="post" action="{{ route('reviews.update', ['reviewlistid' => $reviewlistid, $review->id]) }}" class="mt-6 space-y-6">
                                @csrf
                                @method('patch')

                                <input type="text" name="rating" value="{{$reviewlist->rating}}">
                                <input type="text" name="review" value="{{$reviewlist->review}}">
                                <input type="submit" value="Update">
                                
                            </form>
                        @endisset
                        @empty($review)
                        <form class="dropdown-item flex justify-center" action="{{ route('review.store', ['reviewlistid' => $reviewlistid]) }}" method="POST">
                            @csrf
                            @method('post')

                            <div class="form-group">
                                <label for="rating" name="rating" class="text-50 ">Rating:</label>
                                <input type="number" class="form-control block" id="rating" name="rating" min="1" max="5" required>
                            </div>
                        

                            <!-- Movie Dropdown -->
                            <div class="mt-6">
                                <x-input-label for="movie_id" :value="__('Movie:')" />
                                <select name="movie_id" id="movie_id" class="block mt-1 w-full rounded-lg text-blue-500" required>
                                    @foreach ($movies as $movie)
                                        <option value="{{ $movie->id }}">{{ $movie->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('movie_id')" class="mt-2" />
                            </div>

                            <!-- Review Form -->

                            <div class="form-group">
                                <label for="review" name="review">Review:</label>
                                <textarea class="form-control" id="review" name="review" rows="3"></textarea>
                            </div>
                            <x-primary-button type="submit" class="btn btn-primary">Submit Review</x-primary-button>
                        </form>
                        @endempty
                    </div>
                </div>
                
            </div>
        </div>

    @endsection

</x-app-layout>