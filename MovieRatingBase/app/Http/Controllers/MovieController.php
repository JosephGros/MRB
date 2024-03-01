<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $movies = Movie::all();
        return view('dashboard', ['movies' => $movies]); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->role === 0 || Auth::user()->role === 1)
        {
            return view('admin.edit.editMovie');
        }

        return back()->with('error', 'You are not authorized to do this.');
    }

    // 'actors' => 'required|array',
    //             'actors.*.id' => 'required|exists:actors,id',
    //             'actors.*.role' => 'required|string',
    //             'genres' => 'required|array',
    //             'genres.*' => 'required|exists:genres,id',
    //             'directors' => 'required|array',
    //             'directors.*' => 'required|exists:directors,id',
    //             'writers' => 'required|array',
    //             'writers.*' => 'required|exists:writers,id',

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
        $validated = $request->validate(
            [
                'name' => 'required|string',
                'poster' => 'required|image|mimes:jpeg,png,jpg,gif,jfif',
                'release' => 'required|date_format:Y',
                'runtime' => 'required|string',
                'description' => 'required|string',
                'trailer' => 'required|string',
                
            ]);

        $filename = Str::uuid()->toString() . '.' . $request->file('poster')->getClientOriginalExtension();
        
        $path = $request->file('poster')->storeAs('posters', $filename, 'public');

        $movie = new Movie([
            'name' => $validated['name'],
            'poster' => $path,
            'release' => $validated['release'],
            'runtime' => $validated['runtime'],
            'description' => $validated['description'],
            'trailer' => $validated['trailer'],
        ]);
        $movie->save();

        return view('admin.adminIndex', ['type' => 'movies'])->with('success', 'Movie created successfully'); // Behöver ändras när vi har en sida som den ska redirect till!
        if(!$movie->save())
        {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }catch (\Exception $e) {
        // Log the exception for debugging purposes
        Log::error('Error occurred while saving movie: ' . $e->getMessage());
        return redirect()->back()->with('error', 'An error occurred while saving the movie');
    }
}

            // foreach ($validated['actors'] as $actor)
            // {
            //     $actorId = $actor['id'];
            //     $role = $actor['role'];
            //     $movie->actors()->attach($actorId, ['role' => $role]);
            // }

            // $movie->genres()->attach($validated['genres']);

            // $movie->directors()->attach($validated['directors']);

            // $movie->writers()->attach($validated['writers']);  

            return redirect()->view('admin.edit.editMovie')->with('success', 'Movie created successfully'); // Behöver ändras när vi har en sida som den ska redirect till!
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function show(int $id)
{
    $movie = Movie::with(['ratings', 'actors', 'writers', 'reviews', 'genres', 'directors'])->find($id);

    if (!$movie) 
    {
        return redirect()->route('dashboard')->with('error', 'Movie not found');
    }

    $totalRatings = $movie->ratings->count();
    $sumRatings = $movie->ratings->sum('rating');
    $averageRating = $totalRatings > 0 ? $sumRatings / $totalRatings : 0;

    $averageRating = max(1, min(10, $averageRating));

    // Initialize an empty collection to store similar movies
    $similarMovies = collect();

    foreach ($movie->genres as $genre) {
        // Retrieve similar movies for each genre
        $moviesInGenre = Movie::whereHas('genres', function ($query) use ($genre, $movie) {
            $query->where('genres.id', $genre->id)->whereNotIn('movies.id', [$movie->id]);
        })->get();

        // Add unique movies to the collection
        foreach ($moviesInGenre as $movieInGenre) {
            if (!$similarMovies->contains('id', $movieInGenre->id)) {
                $similarMovies->push($movieInGenre);
            }
        }
    }

    $similarMovies = $similarMovies->take(5); // Limit the number of similar movies to 5

    $latestReview = $movie->reviews()->latest()->first();
    $displayedMovies = collect();

    // Fetch the ID of the first movie in the $similarMovies collection
    $firstMovieId = $similarMovies->first()->id;

    // Add the ID to the $displayedMovies collection
    $displayedMovies->push($firstMovieId);

    return view('display', 
    [
        'movie' => $movie,
        'similarMovies' => $similarMovies,
        'latestReview' => $latestReview,
        'averageRating' => $averageRating,
        'displayedMovies' => $displayedMovies,
    ]);
}



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (Auth::user()->role === 0 || Auth::user()->role === 1)
        {
            $movie = Movie::findOrFail($id);

            return view('admin.edit.editMovie', compact('movie'));
        }

        return back()->with('error', 'You are not authorized to do this.');
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
            'description' => 'sometimes|string',
            'trailer' => 'sometimes|string',
            'actors' => 'sometimes|array',
            'actors.*.id' => 'sometimes|exists:actors,id',
            'actors.*.role' => 'sometimes|string',
            'genres' => 'sometimes|array',
            'genres.*' => 'sometimes|exists:genres,id',
            'directors' => 'sometimes|array',
            'directors.*' => 'sometimes|exists:directors,id',
            'writers' => 'sometimes|array',
            'writers.*' => 'sometimes|exists:writers,id',
        ]);
    
        if(Movie::where('id', $id)->exists()){
            $movie = Movie::find($id);
            $movie->name = $request->input('name', $movie->name);
            $movie->release = $request->input('release', $movie->release);
            $movie->runtime = $request->input('runtime', $movie->runtime);
            $movie->description = $request->input('description', $movie->description);
            $movie->trailer = $request->input('trailer', $movie->trailer);
    
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
                $actors = [];

                foreach ($request->input('actors') as $actorId)
                {
                    $actors[$actorId] = ['role' => $request->input('actor_roles.'.$actorId)];
                }
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
