<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $actor = Actor::all();
        return view('dashboard', ['actor' => $actor]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->role === 0 || Auth::user()->role === 1)
        {
            return view('admin.edit.newPerson', ['type' => 'actors']);
        }

        return back()->with('error', 'You are not authorized to do this.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string',
                'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif,jfif',
                'birth_date' => 'required|date',
                'death_date' => 'nullable|date',
            ]
            );

            $filename = Str::uuid()->toString() . '.' . $request->file('profile_picture')->getClientOriginalExtension();
        
            $path = $request->file('profile_picture')->storeAs('posters', $filename, 'public');

        $actor = new Actor();
        $actor->name = $request->name;
        $actor->profile_picture = $path;
        $actor->birth_date = $request->birth_date;
        $actor->death_date = $request->death_date;

        $actor->save();

        return redirect()->route('admin.index', ['type' => 'actors'])->with('success', 'Actor created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Making the function but might not be used depending on how much time we have.

        $actor = Actor::with(['movies', 'series'])->find($id);

        if(!$actor)
        {
            return redirect()->route('dashboard')->with('Error', 'Actor not found');
        }

        return view('dashboard', ['actor' => $actor]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Edit actor view for admin
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'name' => 'sometimes|string',
                'profile_picture' => 'sometimes|image|mimes:jpeg,png,jpg,gif,jfif',
                'birth_date' => 'sometimes|date',
                'death_date' => 'nullable|date',
            ]
            );

            if(Actor::where('id', $id)->exists())
            {
                $actor = Actor::find($id);
                $actor->name = $request->input('name', $actor->name);
                $actor->birth_date = $request->input('birth_date', $actor->birth_date);
                $actor->death_date = $request->input('death_date', $actor->death_date);

                if ($request->hasFile('profile_picture'))
                {
                    $path = $request->file('profile_picture')->store('profilePic', 'public');
                    $actor->profile_picture = $path;
                }

                $actor->save();

                return redirect()->route('dashboard')->with('success', 'Actor updated successfully');
            } else
            {
                return redirect()->back()->with('Error', 'Could not update actor');
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Actor::where('id', $id)->exists()){

            $actor = Actor::find($id);
            $actor->delete();

            return redirect()->route('admin.edit.editPeople')->with('success', 'Actor deleted successfully');
        } else {
            return redirect()->back()-with('error', 'Could not delete actor');
        }
    }
}
