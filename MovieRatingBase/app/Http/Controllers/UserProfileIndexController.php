<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Serie;
use App\Models\userList;
use App\Models\UserListContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileIndexController extends Controller
{
    public function index(Request $request)
    {   
        $allUserLists = $this->userList();
        $limit = $this->dashboardWatchlist();

        return view('userprofile', compact('allUserLists', 'limit'));
    }

    public function userList()
    {
        $userLists = Auth::user()->userLists;
        $lists = [];
    
        foreach ($userLists as $userList) {
            $listContent = $this->fetchListContent($userList->id);
            
            // Merge movies and series into a single array
            $content = $listContent['movies']->merge($listContent['series'])->unique();
    
            // Take recent 20 items
            $recentContent = $content->take(20);
    
            $lists[] = [
                'list' => $userList,
                'content' => $recentContent,
            ];
        }
    
        return $lists;
    }

    private function fetchListContent($listId)
    {
        $userListContent = UserListContent::where('user_lists_id', $listId)->get();
        $moviesIds = $userListContent->where('media_type', 'movie')->pluck('media_id')->unique();
        $seriesIds = $userListContent->where('media_type', 'serie')->pluck('media_id')->unique();
        $movies = Movie::whereIn('id', $moviesIds)->get();
        $series = Serie::whereIn('id', $seriesIds)->get();

        return [
            'movies' => $movies,
            'series' => $series,
        ];
    }


    public function dashboardWatchlist()
    {
        $media = $this->fetchWatchlist();
        $limit = array_slice($media, 0, 20);

        return $limit;
    }

    private function fetchWatchlist()
    {
        $user = Auth::user();
        $watchlist = $user->watchlist;
        $media = [];

        foreach ($watchlist as $content) 
        {
            if (!is_null($content) && is_object($content)) 
            {
                if ($content->media_type === 'movie') 
                {
                    $movie = Movie::find($content->media_id);
                    if ($movie) {
                        $movie->type = 'movie';
                        $movie->added = $content->created_at;
                        $media[] = $movie;
                    }
                } elseif ($content->media_type === 'serie') 
                {
                    $serie = Serie::find($content->media_id);
                    if ($serie) {
                        $serie->type = 'serie';
                        $serie->added = $content->created_at;
                        $media[] = $serie;
                    }
                }
            }
        }

        usort($media, function ($a, $b) 
        {
            return $b->added <=> $a->added;
        });

        return $media;
    }
}
