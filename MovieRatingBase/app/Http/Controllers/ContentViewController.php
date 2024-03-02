<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContentViewController extends Controller
{
    public function show(Request $request, $source)
    {
        $user = Auth::user();
        $allContent = [];
        $genre = null; // Initiera $genre till null
    
        switch ($source) {
            case 'genre':
                $genre = Genre::findOrFail($request->id); // Tilldela $genre om källan är 'genre'
                $allContent = $genre->movies->merge($genre->series);
                break;
            case 'watchlist':
                $allContent = $this->fetchWatchlist();
                break;
            case 'userlist':
                $allContent = $user->userLists->find($request->id)->contents;
                break;
        }
    
        return view('contentViews.content-view', compact('allContent', 'source', 'genre'));
    }
    
    private function fetchWatchlist()
    {
        $user = Auth::user();
        $watchlist = $user->watchlist;
        $media = [];

        foreach ($watchlist as $content)
        {
            if ($content->media_type === 'movie') {
                $movie = Movie::find($content->media_id);
                if ($movie !== null) {
                    $movie->added = $content->created_at;
                    $media[] = $movie;
                }
            } elseif ($content->media_type === 'serie') {
                $serie = Serie::find($content->media_id);
                if ($serie !== null) {
                    $serie->added = $content->created_at;
                    $media[] = $serie;
                }
            } else {
                continue;
            }
        }

        
        usort($media, function ($a, $b) {
            return $b->added <=> $a->added;
        });

        return $media;
    }
}
