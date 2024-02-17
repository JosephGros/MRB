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
        $movie = Movie::find($id);

        if(!$movie) 
        {
            return redirect()->route('dashboard')->with('error', 'Movie not found');
        }

        return view('movies.dashboard', ['Movies' => $movie]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
