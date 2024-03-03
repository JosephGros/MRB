<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{

    public function create()
    {
        if(Auth::user())
        {
            $movies = Movie::all(); // Assuming you have a Movie model
            return view('contentViews.rating-edit', compact('movies'));
        }

        return redirect()->route('login')->with('error', 'You need to be logged in to submit a rating.');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if(!Auth::check())
        {
            return redirect()->route('login')->with('Error', 'You need to be logged in to rate!');
        }

        $validated = $request->validate(
            [
                'rating' => 'required|numeric|min:1|max:10',
                'movie_id' => 'nullable|exists:movies,id',
                'serie_id' => 'nullable|exists:series,id',
                'episode_id' => 'nullable|exists:episodes,id',
            ]
            );

        $validated['user_id'] = Auth::id();

        if (!isset($validated['serie_id'])) {
            unset($validated['serie_id']);
        }
        if (!isset($validated['episode_id'])) {
            unset($validated['episode_id']);
        }

        $this->validateOnlyOne($validated);

        $rating = Rating::create($validated);

        // Flash success message
        session()->flash('success', 'Rating submitted successfully!');
    
        // Redirect to dashboard route
        return redirect()->route('dashboard');
    }

    private function validateOnlyOne($data)
    {
        // Check if 'serie_id' key exists in the $data array
        if (array_key_exists('serie_id', $data) || array_key_exists('episode_id', $data)) {
            // If 'serie_id' or 'episode_id' key exists, count the number of provided IDs
            $count = count(array_filter([$data['movie_id'], $data['serie_id'], $data['episode_id']]));
        } else {
            // If neither 'serie_id' nor 'episode_id' key exists, count only 'movie_id'
            $count = count(array_filter([$data['movie_id']]));
        }

        // If more than one ID is provided, throw an error
        if ($count != 1) {
            abort(422, "Error: Only one ID (movie_id, serie_id, or episode_id) should be provided.");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rating $rating)
    {
        $validated = $request->validate(
            [
                'rating' => 'required|numeric|min:1|max:10',
                'user_id' => 'required|exists:users,id',
                'movie_id' => 'nullable|exists:movies,id',
                'serie_id' => 'nullable|exists:series,id',
                'episode_id' => 'nullable|exists:episodes,id',
            ]
            );

        if ($rating->user_id !== Auth::id())
        {
            return redirect()->back()->with('Error', "You haven't rated this yet or your not logged in");
        }

        $rating->update($validated);

        return back()->with('success', 'Your rating has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rating $rating)
    {
        if ($rating->user_id !== Auth::id())
        {
            return back()->with('Error', 'You have not rated this or your not logged in');
        }

        $rating->delete();

        return back()->with('success', 'Your rating has been deleted successfully!');
    }
}
