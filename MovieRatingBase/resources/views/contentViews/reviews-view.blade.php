<!-- Display Ratings -->
<h2>Ratings:</h2>
@foreach($averageRating as $rating)
    <div>
        <p>Rating: {{ $rating->rating }}</p>
        <!-- Option to Update Rating -->
        <a href="{{ route('rating.edit', $rating->id) }}">Edit</a>
        <!-- Option to Delete Rating -->
        <form action="{{ route('rating.destroy', $rating->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </div>
@endforeach

<!-- Display Reviews -->
<h2>Reviews:</h2>
@foreach($latestReview as $review)
    <div>
        <p>Review: {{ $review->review }}</p>
        <!-- Option to Update Review -->
        <a href="{{ route('review.edit', $review->id) }}">Edit</a>
        <!-- Option to Delete Review -->
        <form action="{{ route('review.destroy', $review->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </div>
@endforeach
