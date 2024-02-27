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
        $media = $this->fetchWatchlist();
        return view('contentViews.content-view', compact('media'));
    }

    public function dashboardWatchlist()
    {
        $media = $this->fetchWatchlist();
        $limit = array_slice($media, 0, 20);

        return view('dashboard', compact('limit'));
    }

    private function fetchWatchlist()
    {
        $user = Auth::user();
        $watchlist = $user->watchlist;
        $media = [];

        foreach ($watchlist as $content)
        {
            if($content->media_type === 'movie'){
                $movie = Movie::find($content->media_id);
                $movie->type = 'movie';
                $movie->added = $content->created_at;
                $media[] = $movie;
            } elseif($content->media_type === 'serie'){
                $serie = Serie::find($content->media_id);
                $serie->type = 'serie';
                $serie->added = $content->created_at;
                $media[] = $serie;
            }
        }

        usort($media, function ($a, $b)
        {
            return $a->added <=> $b->added;
        });

        return $media;
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
