<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Serie;
use App\Models\userList;
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
        $userLists = Auth::user()->userLists->latest()->get();
        $allUserLists = [];

        foreach($userLists as $userList)
        {
            $listContent = $this->fetchListContent($userList->id)->sortByDesc('created_at');
            $recent = array_slice($listContent, 0, 20);
            $allUserLists[] = [
                'list' => $userList,
                'content' => $recent,
            ];
        }

        return $allUserLists;
    }

    private function fetchListContent($listId)
    {
        $list = Auth::user()->userList()->findOrFail($listId);

        return $list->contents()->latest()->get();
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
