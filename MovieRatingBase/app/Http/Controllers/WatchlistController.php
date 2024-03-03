<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Serie;
use App\Models\Watchlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WatchlistController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $media = $this->fetchAllWatchlist();
        return view('contentViews.content-view', compact('media'));
    }

    // public function dashboardWatchlist()
    // {
    //     $media = $this->fetchWatchlist();
    //     $limit = array_slice($media, 0, 20);

    //     return view('dashboard', compact('limit'));
    // }

    private function fetchAllWatchlist()
    {
        $user = Auth::user();
        $watchlist = $user->watchlist;
        $media = [];

        
            foreach ($watchlist as $content)
            {
                if('media_type' === 'movie')
                {
                    $movie = Movie::find($content->media_id);
        
                    $media[] = $movie;
                }else {
                    continue;
                }
            }
        

        return view('contentView.content-view', compact('media'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'movie_id' => 'required|exists:movies,id',
        ]);

        $user = Auth::user();
        $watchlist = $user->watchlist->first();

        if ($watchlist->media_id === $validated['movie_id'] && $watchlist->media_type === 'movie') {
            return back()->with('error', 'This movie is already in your watchlist.');
        }

        $watchlist->create([
            'user_id' => $user->id,
            'media_id' => $validated['movie_id'],
            'media_type' => 'movie',
        ]);

        return back()->with('success', 'Movie added to watchlist!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = auth()->user();
        $watchlist = Watchlist::where('user_id', $user->id)
                            ->where('media_id', $id)
                            ->first();

        if ($watchlist) {
            $watchlist->delete();
            return back()->with('success', 'Movie removed from watchlist.');
        }

        return back()->with('error', 'Movie not found in your watchlist.');
    }
}
