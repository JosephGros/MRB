<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if(!Auth::check())
        {
            return redirect()->back()->with('Error', 'You need to be logged in to rate!');
        }

        $validated = $request->validate(
            [
                'rating' => 'required|numeric|min:1|max:10',
                'user_id' => 'required|exists:users,id',
                'movie_id' => 'nullable|exists:movies,id',
                'serie_id' => 'nullable|exists:series,id',
                'episode_id' => 'nullable|exists:episodes,id',
            ]
            );

        $validated['user_id'] = Auth::id();

        $this->validateOnlyOne($validated);

        $rating = Rating::create($validated);

        return redirect()->back()->with('success', 'Thanks for rating!');
    }

    private function validateOnlyOne($data)
    {
        $count = count(array_filter([$data['movie_id'], $data['serie_id'], $data['episode_id']]));
        if($count != 1){
            abort(422, 'Error to many id');
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
