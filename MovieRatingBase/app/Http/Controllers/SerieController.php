<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Season;
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
        $validated = $request->validate(
            [
                'series.name' => 'required|string',
                'series.poster' => 'required|image|mimes:jpeg,png,jpg,gif,jfif',
                'series.release' => 'required|date_format:Y',
                'series.end' => 'nullable|date_format:Y',
                'series.runtime' => 'required|string',
                'series.description' => 'required|text',
                'series.trailer' => 'required|string',
                'series.seasons' => 'required|array|min:1',
                'series.seasons.*.name' => 'required|string',
                'series.seasons.*.number_of_episodes' => 'required|integer|min:1',
                'series.seasons.*.episodes' => 'required|array|min:1',
                'series.seasons.*.episodes.*.name' => 'required|string',
                'series.seasons.*.episodes.*.episode_count' => 'required|string',
                'series.seasons.*.episodes.*.runtime' => 'required|string',
                'series.seasons.*.episodes.*.release_date' => 'required|string',
                'actors' => 'required|array',
                'actors.*.id' => 'required|exists:actors,id',
                'actors.*.role' => 'required|string',
                'genres' => 'required|array',
                'genres.*' => 'required|exists:genres,id',
                'creators' => 'required|array',
                'creators.*' => 'required|exists:directors,id',
                'writers' => 'required|array',
                'writers.*' => 'required|exists:writers,id',
            ]);
        
        $path = $request->file('poster')->store('posters', 'public');

        $series = Serie::create($validated['series']);
        
        foreach ($validated['series']['season'] as $season)
        {
            $season = $series->seasons()->create($season);
        }

        foreach ($validated['episode'] as $episode)
        {
            $episode['season_id'] = $season->id;
            $episode = $season->episode()->create($episode);
        }

        foreach ($validated['actor'] as $actor)
        {
            $actorId = $actor['id'];
            $role = $actor['role'];
            $series->actors()->attach($actorId, ['role' => $role]);
        }
        if($series->save())
        {
            $series->genres()->sync($request->genres);
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

        return view('display', 
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
            'series.name' => 'sometimes|string',
            'series.poster' => 'sometimes|image|mimes:jpeg,png,jpg,gif,jfif',
            'series.release' => 'sometimes|date_format:Y',
            'series.end' => 'nullable|date_format:Y',
            'series.runtime' => 'sometimes|string',
            'series.description' => 'sometimes|text',
            'series.trailer' => 'sometimes|string',
            'series.seasons' => 'required|array|min:1',
            'series.seasons.*.name' => 'required|string',
            'series.seasons.*.number_of_episodes' => 'required|integer|min:1',
            'series.seasons.*.episodes' => 'required|array|min:1',
            'series.seasons.*.episodes.*.name' => 'required|string',
            'series.seasons.*.episodes.*.episode_count' => 'required|string',
            'series.seasons.*.episodes.*.runtime' => 'required|string',
            'series.seasons.*.episodes.*.release_date' => 'required|string',
            'actors' => 'sometimes|array',
            'actors.*.id' => 'required_with:actors|exists:actors,id',
            'actors.*.role' => 'required_with:actors|string',
            'genres' => 'sometimes|array',
            'genres.*' => 'required_with:genres|exists:genres,id',
            'creators' => 'sometimes|array',
            'creators.*' => 'required_with:creators|exists:directors,id',
            'writers' => 'sometimes|array',
            'writers.*' => 'required_with:writers|exists:writers,id',
        ]);
        
    
        if(Serie::where('id', $id)->exists()){
            $series = Serie::findOrFail($id);

            $series->update($request->input['series']);
    
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
                $actors = [];

                foreach ($request->input('actors') as $actorId)
                {
                    $actors[$actorId] = ['role' => $request->input('actor_roles.'.$actorId)];
                }
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

            if($request->has('series.seasons'))
            {
                foreach ($request->input('series.seasons') as $seasons)
                {
                    if (isset($seasons['id']))
                    {
                        $season = Season::findOrFail($seasons['id']);
                        $season->update($seasons);
                    } else {
                        $season = $series->seasons()->create($seasons);
                    }   
                

                    if(isset($seasons['episodes']))
                    {
                        foreach ($seasons['episodes'] as $episodes)
                        {
                            if (isset($episodes['id']))
                            {
                                $episode = Episode::findOrFail($episodes['id']);
                                $episode->update($episodes);
                            } else {
                                $episode = $season->episodes()->create($episodes);
                            }   
                        }
                    }
                }
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
