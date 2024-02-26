<?php

namespace App\Http\Controllers;

use App\Models\Season;
use App\Models\Serie;
use Illuminate\Http\Request;

class SeasonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $seasons = Season::all();
        return view('dashboard', ['seasons' => $seasons]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return admin create view seasons
    }

    public function storeWithEpisodes(Request $request, EpisodeController $episodeController)
    {
        $request->validate(
            [
                // Season validation
                'name' => 'required|string',
                'number_of_episodes' => 'required|string',
                'series_id' => 'required|exists:series,id',

                // Episode validation
                'episodes' => 'required|array|min:1',
                'episodes.*.episode_count' => 'required|string',
                'episodes.*.name' => 'required|string',
                'episodes.*.runtime' => 'required|string',
                'episodes.*.description' => 'required|text',
                'episodes.*.season_id' => 'required|exists:seasons,id',
                'episodes.*.release_date' => 'required|date',
            ]);

        $season = $this->store(
            $request->input('name'),
            $request->input('number_of_episodes'),
            $request->input('series_id')
        );

        $episodeController->store($season->id, $request->input('episodes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($name, $number_of_episodes, $series_id)
    {
        $season = new Season();

        $season->name = $name;
        $season->number_of_episodes = $number_of_episodes;
        $season->series_id = $series_id;
        
        if($season->save())
        {
            return $season;
            return redirect()->route('dashboard')->with('success', 'Season created successfully'); // Behöver ändras när vi har en sida som den ska redirect till!
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function seriesSearch(Request $request)
    {
        $query = $request->input('query');

        $series = strlen($query) > 0 ? Serie::where('name', 'id', "%{$query}%")->pluck('name', 'id')->all() : [];

        return response()->json($series);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $seasons = Season::with(['episodes'])->find($id);

        if (!$seasons) 
        {
            return redirect()->route('dashboard')->with('error', 'Season not found');
        }

        return view('dashboard', ['seasons' => $seasons,]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //return edit view for season admin
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'sometimes|string',
            'number_of_episodes' => 'sometimes|string',
            'series_id' => 'sometimes|exists:series_id',
        ]);
    
        if(Season::where('id', $id)->exists()){
            $seasons = Season::find($id);
            $seasons->name = $request->input('name', $seasons->name);
            $seasons->number_of_episodes = $request->input('number_of_episodes', $seasons->number_of_episodes);
            $seasons->series_id = $request->input('series_id', $seasons->series_id);
            $seasons->save();

            return redirect()->route('seasons.dashboard', $seasons->id)->with('success', 'Serie updated successfully');
        } else {
            return redirect()->back()->with('error', 'Serie not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Season::where('id', $id)->exists()){

            $seasons = Season::find($id);
            $seasons->delete();

            return redirect()->route('seasons.dashboard', $seasons->id)->with('success', 'Season deleted successfully');
        } else {
            return redirect()->back()-with('error', 'Season not found');
        }
    }
}
