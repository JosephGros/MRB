<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Creator;
use App\Models\Director;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Serie;
use App\Models\Writer;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        $movies = Movie::where('name', 'like', "%{$query}%")->get();
        $series = Serie::where('name', 'like', "%{$query}%")->get();
        $genres = Genre::where('name', 'like', "%{$query}%")->get();
        $actors = Actor::where('name', 'like', "%{$query}%")->get();
        $directors = Director::where('name', 'like', "%{$query}%")->get();
        $creators = Creator::where('name', 'like', "%{$query}%")->get();
        $writers = Writer::where('name', 'like', "%{$query}%")->get();

        $results = [
            'movies' => $movies,
            'series' => $series,
            'genres' => $genres,
            'actors' => $actors,
            'director' => $directors,
            'creators' => $creators,
            'writers' => $writers,
        ];

        return response()->json($results);
    }
}
