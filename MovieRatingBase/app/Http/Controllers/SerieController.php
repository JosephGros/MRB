<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;

class SerieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $series = Serie::all();
        return view('dashboard', ['series' => $series]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return serie create form for admin
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

        $series = new Serie();
        $series->name = $request->name;
        $series->poster = $path;
        $series->release = $request->release;
        $series->runtime = $request->runtime;
        $series->description = $request->description;
        
        if($series->save())
        {
            $series->genres()->sync($request->genres);
            $series->actors()->sync($request->actors);
            $series->creators()->sync($request->creators);
            $series->writers()->sync($request->writers);

            return redirect()->route('dashboard')->with('success', 'Serie created successfully'); // Behöver ändras när vi har en sida som den ska redirect till!
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $serie = Serie::with(['ratings', 'actors', 'writers', 'reviews', 'genres', 'creators', 'seasons'])->find($id);

        if (!$serie) 
        {
            return redirect()->route('dashboard')->with('error', 'Serie not found');
        }

        $totalRatings = $serie->ratings->count();
        $sumRatings = $serie->ratings->sum('rating');
        $averageRating = $totalRatings > 0 ? $sumRatings / $totalRatings : 0;

        $averageRating = max(1, min(10, $averageRating));

        $similarSeries = Serie::whereHas('genres', function ($query) use ($serie)
        {
            $query->whereIn('id', $serie->genres->pluck('id'));
        })->where('id', '!=', $id)->take(5)->get();

        $latestReview = $serie->review()->latest()->first();

        return view('dashboard', 
        [
            'serie' => $serie,
            'similarSeries' => $similarSeries,
            'latestReview' => $latestReview,
            'averageRating' => $averageRating,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Return series edit form for admin
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
    
        if(Serie::where('id', $id)->exists()){
            $series = Serie::find($id);
            $series->name = $request->input('name', $series->name);
            $series->release = $request->input('release', $series->release);
            $series->runtime = $request->input('runtime', $series->runtime);
            $series->description = $request->input('description', $series->description);
    
            if ($request->hasFile('poster')) {
                $path = $request->file('poster')->store('posters', 'public');
                $series->poster = $path;
            }
    
            $series->save();

            if($request->has('genres'))
            {
                $series->genres()->sync($request->genres);
            }

            if($request->has('actors'))
            {
                $series->actors()->sync($request->actors);
            }

            if($request->has('creators'))
            {
                $series->creators()->sync($request->creators);
            }

            if($request->has('writers'))
            {
                $series->writers()->sync($request->writers);
            }
    
            return redirect()->route('series.dashboard', $series->id)->with('success', 'Serie updated successfully');
        } else {
            return redirect()->back()->with('error', 'Serie not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Serie::where('id', $id)->exists()){

            $series = Serie::find($id);
            $series->delete();

            return redirect()->route('series.dashboard', $series->id)->with('success', 'Serie deleted successfully');
        } else {
            return redirect()->back()-with('error', 'Serie not found');
        }
    }
}
