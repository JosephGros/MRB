<?php

namespace App\Http\Controllers;

use App\Models\Director;
use Illuminate\Http\Request;

class DirectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $director = Director::all();
        return view('dashboard', ['director' => $director]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // create director view for admin
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'require|string',
                'profile_picture' => 'require|image|mimes:jpeg,png,jpg,gif,jfif',
                'birth_date' => 'require|date',
                'death_date' => 'nullable|date',
            ]
            );

        $path = $request->file('profile_pictrue')->store('profilePic', 'public');

        $director = new Director();
        $director->name = $request->name;
        $director->profile_picture = $path;
        $director->birth_date = $request->birth_date;
        $director->death_date = $request->death_date;

        if($director->save())
        {
            return redirect()->route('dashboard')->with('success', 'Director created successfully');
        } else
        {
            return redirect()->back()->with('Error', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Making the function but might not be used depending on how much time we have.

        $director = Director::with(['movies', 'series'])->find($id);

        if(!$director)
        {
            return redirect()->route('dashboard')->with('Error', 'Director not found');
        }

        return view('dashboard', ['director' => $director]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // edit view for admin
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

            if(Director::where('id', $id)->exists())
            {
                $director = new Director();
                $director->name = $request->input('name', $director->name);
                $director->birth_date = $request->input('birth_date', $director->birth_date);
                $director->death_date = $request->input('death_date', $director->death_date);

                if ($request->hasFile('profile_picture'))
                {
                    $path = $request->file('profile_picture')->store('profilePic', 'public');
                    $director->profile_picture = $path;
                }

                $director->save();

                return redirect()->route('dashboard')->with('success', 'Director updated successfully');
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
        if(Director::where('id', $id)->exists()){

            $director = Director::find($id);
            $director->delete();

            return redirect()->route('director.dashboard', $director->id)->with('success', 'Director deleted successfully');
        } else {
            return redirect()->back()-with('error', 'Could not delete director');
        }
    }
}
