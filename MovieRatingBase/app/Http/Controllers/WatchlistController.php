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
        $watchlistMedia = $this->fetchWatchlist(); // Ändra namnet från $media till $watchlistMedia
        return view('contentViews.content-view', compact('watchlistMedia'));
    }


    public function dashboardWatchlist()
    {
        $user = Auth::user();

        if ($user && $user->watchlist) {
            $media = $this->fetchWatchlist();
            // Om $media innehåller arrayer, konvertera dem till objekt
            $limit = collect($media)->map(function ($item) {
                return (object) $item;
            })->slice(0, 20)->toArray();
        } else {
            $limit = [];
        }

        return $limit;
    }

    private function fetchWatchlist()
    {
        $user = Auth::user();

        // Kontrollera om användaren är inloggad och om de har en watchlist
        if ($user && $user->watchlist) {
            $watchlistItems = $user->watchlist()->get();
            $media = [];

            foreach ($watchlistItems as $content) {
                if ($content->media_type === 'movie') {
                    $movie = Movie::find($content->media_id);
                    if ($movie) {
                        $media[] = [
                            'type' => 'movie',
                            'title' => $movie->title,
                            'poster' => $movie->poster,
                            'added' => $content->created_at ? $content->created_at : null, // Set added attribute or null
                        ];
                    }
                } elseif ($content->media_type === 'serie') {
                    $serie = Serie::find($content->media_id);
                    if ($serie) {
                        $media[] = [
                            'type' => 'serie',
                            'title' => $serie->title,
                            'poster' => $serie->poster,
                            'added' => $content->created_at ? $content->created_at : null, // Set added attribute or null
                        ];
                    }
                }
            }

            usort($media, function ($a, $b) {
                return $b['added'] <=> $a['added'];
            });

            return $media;
        } else {
            return [];
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function addToWatchlist(Request $request)
    {
        $validated = $request->validate([
            'media_id' => 'required|exists:movies,id|exists:series,id',
        ]);

        $user = Auth::user();
        $watchlist = $user->watchlist;

        $watchlist->media()->attach($validated['media_id']);

        // Redirect tillbaka till watchlist-sidan efter att filmen har lagts till
        return redirect()->route('watchlist.index')->with('success', 'Added to watchlist!');
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
