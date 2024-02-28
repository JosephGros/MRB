<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = $request->input('filter', 'all');

        $genres = Genre::all();
        $latestInGenre = [];

        foreach ($genres as $genre)
        {
            switch ($filter)
            {
                case 'movies':
                    $latest = $genre->movies()->latest()->take(20)->get();
                    break;
                case 'series':
                    $latest = $genre->series()->latest()->take(20)->get();
                    break;
                default:
                    $latest = $genre->items()->latest()->take(20)->get();
                    break;
            }

            $latestInGenre[$genre->name] = $latest;
        }

        return view('dashboard', compact('latestInGenre'));
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

        return view('dashboard', compact('randomContent'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Create view for genre admin
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
        [
            'name' => 'required|string',
        ]);

        $genre = new Genre();
        $genre->name = $request->name;

        if($genre->save())
        {
            return redirect()->route('dashboard')->with('success', 'Genre created successfully!');
        } else 
        {
            return redirect()->back()->with('Error', 'Something went wrong.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $genre = Genre::findOrFail($id);

        $allGenreContent = $genre->movies->merge($genre->series);
        $allGenreContent = $allGenreContent->sortByDesc('created_at');

        return view('content-view', compact('genre', 'allGenreContent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Genre edit view for admin
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'name' => 'sometimes|string',
            ]);

        if(Genre::where('id', $id)->exists()){
            $genre = Genre::find($id);
            $genre->name = $request->input('name', $genre->name);

            $genre->save();
    
            return redirect()->route('genre.dashboard', $genre->id)->with('success', 'Genre updated successfully');
        } else {
            return redirect()->back()->with('error', 'Genre not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Genre::where('id', $id)->exists()){

            $genre = Genre::find($id);
            $genre->delete();

            return redirect()->route('genre.dashboard', $genre->id)->with('success', 'Genre deleted successfully');
        } else {
            return redirect()->back()-with('error', 'Genre not found');
        }
    }
}
