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
        $movies = Movie::get()->toJson(JSON_PRETTY_PRINT);
        return response($movies, 200);
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
            return response()->json(['message' => 'Movie created Successfully'
            ], 201);
        } 
            return response()->json(['message' => 'Something went wrong'
            ], 500);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
