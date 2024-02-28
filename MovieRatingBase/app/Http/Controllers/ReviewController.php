<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

    public function create()
    {
        if(Auth::user())
        {
            return view('contentViews.review-edit');
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::check())
        {
            return redirect()->route('review.show')->with('Error', 'You need to be logged in to review!');
        }

        $validated = $request->validate(
            [
                'review' => 'required|string',
                'user_id' => 'required|exists:users,id',
                'movie_id' => 'nullable|exists:movies,id',
                'serie_id' => 'nullable|exists:series,id',
            ]
            );

        $validated['user_id'] = Auth::id();

        $this->validateOnlyOne($validated);

        $rating = Review::create($validated);

        return redirect()->back()->with('success', 'Thanks for your review!');
    }

    private function validateOnlyOne($data)
    {
        $count = count(array_filter([$data['movie_id'], $data['serie_id']]));
        if($count != 1){
            abort(422, "Error to many id's");
        }
    }

    /**
     * Display the specified resource.  Review::where('movie_id', $review->movie_id)
     */
    public function show(string $id)
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

        return view('contentViews.reviews-view', ['review' => $review, 'relatedReviews' => $relatedReviews]);
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
