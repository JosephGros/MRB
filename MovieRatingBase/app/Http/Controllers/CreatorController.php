<?php

namespace App\Http\Controllers;

use App\Models\Creator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $creator = Creator::all();
        return view('dashboard', ['creator' => $creator]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->role === 0 || Auth::user()->role === 1)
        {
            return view('admin.edit.newPerson', ['type' => 'creators']);
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
                'name' => 'require|string',
                'profile_picture' => 'require|image|mimes:jpeg,png,jpg,gif,jfif',
                'birth_date' => 'require|date',
                'death_date' => 'nullable|date',
            ]
            );

        $path = $request->file('profile_pictrue')->store('profilePic', 'public');

        $creator = new Creator();
        $creator->name = $request->name;
        $creator->profile_picture = $path;
        $creator->birth_date = $request->birth_date;
        $creator->death_date = $request->death_date;

        if($creator->save())
        {
            return redirect()->route('dashboard')->with('success', 'Creator created successfully');
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

        $creator = Creator::with(['movies', 'series'])->find($id);

        if(!$creator)
        {
            return redirect()->route('dashboard')->with('Error', 'Creator not found');
        }

        return view('dashboard', ['creator' => $creator]);
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

            if(Creator::where('id', $id)->exists())
            {
                $creator = new Creator();
                $creator->name = $request->input('name', $creator->name);
                $creator->birth_date = $request->input('birth_date', $creator->birth_date);
                $creator->death_date = $request->input('death_date', $creator->death_date);

                if ($request->hasFile('profile_picture'))
                {
                    $path = $request->file('profile_picture')->store('profilePic', 'public');
                    $creator->profile_picture = $path;
                }

                $creator->save();

                return redirect()->route('dashboard')->with('success', 'Creator updated successfully');
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
        if(Creator::where('id', $id)->exists()){

            $creator = Creator::find($id);
            $creator->delete();

            return redirect()->route('creator.dashboard', $creator->id)->with('success', 'Creator deleted successfully');
        } else {
            return redirect()->back()-with('error', 'Could not delete creator');
        }
    }
}
