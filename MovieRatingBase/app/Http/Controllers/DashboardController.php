<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{

    public function index(Request $request)
    {

        if(Auth::user())
        {
            $latestInGenre = $this->getGenres($request);
            $randomContent = $this->randomDashboard();
            $limit = $this->dashboardWatchlist();

            return view('dashboard', compact('latestInGenre', 'randomContent', 'limit'));
        } else {

            $latestInGenre = $this->getGenres($request);
            $randomContent = $this->randomDashboard();

            return view('welcome', compact('latestInGenre', 'randomContent'));
        }
        $randomContent = $this->randomDashboard();
    }
    
    public function indexGuest(Request $request)
    {
        $latestInGenre = $this->getGenres($request);
        $randomContent = $this->randomDashboard();

        return view('welcome', compact('latestInGenre', 'randomContent'));
    }
    
    

    public function getGenres(Request $request)
    {
        $filter = $request->input('filter', 'all');

        $genres = Genre::all();
        $latestInGenre = [];

        foreach ($genres as $genre)
        {
            if ($filter === 'movies')
            {
                $movies = $genre->movies()->latest()->take(20)->get();
                $latestInGenre[] = [
                    'id' => $genre->id,
                    'name' => $genre->name,
                    'items' => $movies,
                ];
            } elseif ($filter === 'series')
            {
                $series = $genre->series()->latest()->take(20)->get();
                $latestInGenre[] = [
                    'id' => $genre->id,
                    'name' => $genre->name,
                    'items' => $series,
                ];
            } else 
            {
                $latestMovies = $genre->movies()->latest()->take(10)->get(); 
                $latestSeries = $genre->series()->latest()->take(10)->get();
                $mix = $latestMovies->concat($latestSeries)->shuffle();
                $latestInGenre[$genre->id] = [
                    'id' => $genre->id,
                    'name' => $genre->name,
                    'items' => $mix,
                ];
            }

            
        }

        return $latestInGenre;
    }

    public function randomDashboard()
    {
        if (Cache::has('random_content'))
        {
            $randomContent = Cache::get('random_content');

        } else {

            $movies = Movie::all();
            $series = Serie::all();

            $mixContent = $movies->merge($series);
            $mixContent = $mixContent->shuffle();

            $randomContent = $mixContent->take(3);

            Cache::put('random_content', $randomContent, 24 * 60);

        }

        return $randomContent;
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

        return $media;
    }

}
