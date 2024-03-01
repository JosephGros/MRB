<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Serie;
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

    public function dashboardWatchlist()
    {
        $media = $this->fetchWatchlist();
        $limit = array_slice($media, 0, 20);

        return view('dashboard', compact('limit'));
    }

    private function fetchFullWatchlist()
    {
        $user = Auth::user();
        $watchlist = $user->watchlist;
        $media = [];

        foreach ($watchlist as $content)
        {
            if ($content->media_type === 'movie') {
                $movie = Movie::find($content->media_id);
                if ($movie !== null) { // Kontrollera om $movie inte är null
                    $movie->added = $content->created_at;
                    $media[] = $movie;
                }
            } elseif ($content->media_type === 'serie') {
                $serie = Serie::find($content->media_id);
                if ($serie !== null) { // Kontrollera om $serie inte är null
                    $serie->added = $content->created_at;
                    $media[] = $serie;
                }
            } else {
                continue;
            }
        }

        usort($media, function ($a, $b) 
        {
            return $b->added <=> $a->added;
        });

        return view('contentView.content-view', compact('media'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'media_id' => 'required|exists:movies,id|exists:series,id',
            ]
        );

        $user = Auth::user();
        $watchlist = $user->watchlist;

        $watchlist->media()->attach($validated['media_id']);

        return back()->with('success', 'Added to watchlist!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($mediaId)
    {
        $user = Auth::user();
        $watchlist = $user->watchlist;

        $watchlist->media()->detach($mediaId);

        return back()->with('success', 'Removed from watchlist!');
    }
}
