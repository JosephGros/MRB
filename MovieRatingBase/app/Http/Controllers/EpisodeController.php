<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use Illuminate\Http\Request;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $episode = Episode::all();
        return view('dashboard', ['episode' => $episode]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return form for creating episode admin
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($seasonId, $episodesInfo)
    {
        foreach ($episodesInfo as $episodeInfo)
        {
            $episode = new Episode();

            $episode->fill($episodeInfo);
            $episode->season_id = $seasonId;
            $episode->save();
        }
        
        if($episode->save())
        {
            return redirect()->route('dashboard')->with('success', 'Episode created successfully'); // Behöver ändras när vi har en sida som den ska redirect till!
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Wont be needed.
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Edit episode for admin
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'episode_count' => 'sometimes|string', // Ep1, Ep2, Ep 3 and so on.
            'name' => 'sometimes|string',
            'runtime' => 'sometimes|string',
            'description' => 'sometimes|text',
            'season_id' => 'sometimes|exists:seasons,id',
            'release_date' => 'sometimes|date',
        ]);
    
        if(Episode::where('id', $id)->exists()){
            $episode = Episode::find($id);
            $episode->episode_count = $request->input('episode_count', $episode->episode_count);
            $episode->name = $request->input('name', $episode->name);
            $episode->runtime = $request->input('runtime', $episode->runtime);
            $episode->description = $request->input('description', $episode->description);
            $episode->season_id = $request->input('season_id', $episode->season_id);
            $episode->release_date = $request->input('release_date', $episode->release_date);
            $episode->save();

            return redirect()->route('episode.dashboard', $episode->id)->with('success', 'Episode updated successfully');
        } else {
            return redirect()->back()->with('error', 'Episode not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Episode::where('id', $id)->exists()){

            $episode = Episode::find($id);
            $episode->delete();

            return redirect()->route('episode.dashboard', $episode->id)->with('success', 'Episode deleted successfully');
        } else {
            return redirect()->back()-with('error', 'Episode not found');
        }
    }
}
