<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Returns all movies in JSON format to be displayed in dashboard
        $movies = Movie::all();
        return view('dashboard', ['movies' => $movies]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return movie create form for admin
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string',
                'poster' => 'required|image|mimes:jpeg,png,jpg,gif,jfif',
                'release' => 'required|date_format:Y',
                'runtime' => 'required|string',
                'description' => 'required|text',
            ]);
        
        $path = $request->file('poster')->store('posters', 'public');

        $movie = new Movie();
        $movie->name = $request->name;
        $movie->poster = $path;
        $movie->release = $request->release;
        $movie->runtime = $request->runtime;
        $movie->description = $request->description;
        
        if($movie->save())
        {
            $movie->genres()->sync($request->genres);
            $movie->actors()->sync($request->actors);
            $movie->directors()->sync($request->directors);
            $movie->writers()->sync($request->writers);
            
            return redirect()->route('dashboard')->with('success', 'Movie created successfully'); // Behöver ändras när vi har en sida som den ska redirect till!
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $movie = Movie::with(['ratings', 'actors', 'writers', 'reviews', 'genres', 'directors'])->find($id);

        if (!$movie) 
        {
            return redirect()->route('dashboard')->with('error', 'Movie not found');
        }

        $similarMovies = Movie::whereHas('genres', function ($query) use ($movie)
        {
            $query->whereIn('id', $movie->genres->pluck('id'));
        })->where('id', '!=', $id)->take(5)->get();

        $latestReview = $movie->review()->latest()->first();

        return view('dashboard', 
        [
            'movie' => $movie,
            'similarMovies' => $similarMovies,
            'latestReview' => $latestReview,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Return movie edit form for admin
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'sometimes|string',
            'poster' => 'sometimes|image|mimes:jpeg,png,jpg,gif,jfif',
            'release' => 'sometimes|date_format:Y',
            'runtime' => 'sometimes|string',
            'description' => 'sometimes|string'
        ]);
    
        if(Movie::where('id', $id)->exists()){
            $movie = Movie::find($id);
            $movie->name = $request->input('name', $movie->name);
            $movie->release = $request->input('release', $movie->release);
            $movie->runtime = $request->input('runtime', $movie->runtime);
            $movie->description = $request->input('description', $movie->description);
    
            if ($request->hasFile('poster')) {
                $path = $request->file('poster')->store('posters', 'public');
                $movie->poster = $path;
            }
    
            $movie->save();

            if($request->has('genres'))
            {
                $movie->genres()->sync($request->genres);
            }

            if($request->has('actors'))
            {
                $movie->actors()->sync($request->actors);
            }

            if($request->has('directors'))
            {
                $movie->directors()->sync($request->directors);
            }

            if($request->has('writers'))
            {
                $movie->writers()->sync($request->writers);
            }
    
            return redirect()->route('movies.dashboard', $movie->id)->with('success', 'Movie updated successfully');
        } else {
            return redirect()->back()->with('error', 'Movie not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Movie::where('id', $id)->exists()){

            $movie = Movie::find($id);
            $movie->delete();

            return redirect()->route('movies.dashboard', $movie->id)->with('success', 'Movie deleted successfully');
        } else {
            return redirect()->back()-with('error', 'Movie not found');
        }
    }
}
