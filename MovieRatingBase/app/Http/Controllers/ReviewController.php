<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

    public function create()
    {
        if(Auth::user())
        {
            $movies = Movie::all(); // Assuming you have a Movie model
            return view('contentViews.review-edit', compact('movies'));
        }

        return redirect()->route('login')->with('error', 'You need to be logged in to submit a review.');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::check())
        {
            return redirect()->route('login')->with('Error', 'You need to be logged in to review!');
        }

        $validated = $request->validate(
            [
                'review' => 'required|string',
                'movie_id' => 'nullable|exists:movies,id',
                'serie_id' => 'nullable|exists:series,id',
            ]
            );

        $validated['user_id'] = Auth::id();

        if (!isset($validated['serie_id'])) {
            unset($validated['serie_id']);
        }

        $this->validateOnlyOne($validated);

        $review = Review::create($validated);
      
               // Flash success message
        session()->flash('success', 'Review submitted successfully!');
    
        // Redirect to dashboard route
        return redirect()->route('dashboard');
    }

    private function validateOnlyOne($data)
    {
            // Check if 'serie_id' key exists in the $data array
            if (array_key_exists('serie_id', $data)) {
                // If 'serie_id' key exists, count the number of provided IDs
                $count = count(array_filter([$data['movie_id'], $data['serie_id']]));
            } else {
                // If 'serie_id' key doesn't exist, count only 'movie_id'
                $count = count(array_filter([$data['movie_id']]));
            }
        // $count = count(array_filter([$data['movie_id'], $data['serie_id']]));
        if($count != 1){
            abort(422, "Error to many id's");
        }
    }
    

    

    /**
     * Display the specified resource.  Review::where('movie_id', $review->movie_id)
     */
    public function show(int $id)
    {
        $review = Review::findOrFail($id);
        $relatedReviews = collect();

        if($review->movie_id)
        {
            $relatedReviews = Review::where('movie_id', $review->movie_id)->where('id', '!=', $review->id)
            ->orderBy('created_at', 'desc')->get();
        } elseif($review->serie_id)
        {
            $relatedReviews = Review::where('serie_id', $review->serie_id)->where('id', '!=', $review->id)
            ->orderBy('created_at', 'desc')->get();
        }

        return view('contentViews.reviews-view', ['review' => $review,'id' => $id, 'relatedReviews' => $relatedReviews]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $review = Review::findOrFail($id);

        if (!(Auth::user()->role === 0 || Auth::user()->role === 1) || Auth::id() !== $review->user_id)
        {
            return redirect()->back()->with('Error', 'You are not authorized to edit this review.');
        }

        return view('contentViews.reviews-edit', ['review' => $review]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $review = Review::findOrFail($id);

        if (!(Auth::user()->role === 0 || Auth::user()->role === 1) || Auth::id() !== $review->user_id)
        {
            return redirect()->back()->with('Error', 'You are not authorized to edit this review.');
        }

        $validated = $request->validate(
            [
                'review' => 'nullable|string',
            ]); 

        $review->update($validated);

        return redirect()->route('review.show')->with('success', 'Review updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $review = Review::findOrFail($id);

        if (!(Auth::user()->role === 0 || Auth::user()->role === 1) || Auth::id() !== $review->user_id)
        {
            return redirect()->back()->with('Error', 'You are not authorized to delete this review.');
        }

        $review->delete();

        return redirect()->back()->with('success', 'Review deleted successfully!');
    }
}
