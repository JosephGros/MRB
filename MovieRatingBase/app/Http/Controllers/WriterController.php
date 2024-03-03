<?php

namespace App\Http\Controllers;

use App\Models\Writer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WriterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $writer = Writer::all();
        return view('dashboard', ['writer' => $writer]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->role === 0 || Auth::user()->role === 1)
        {
            return view('admin.edit.newPerson', ['type' => 'writers']);
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

        $writer = new Writer();
        $writer->name = $request->name;
        $writer->profile_picture = $path;
        $writer->birth_date = $request->birth_date;
        $writer->death_date = $request->death_date;

        if($writer->save())
        {
            return redirect()->route('dashboard')->with('success', 'Writer created successfully');
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

        $writer = Writer::with(['movies', 'series'])->find($id);

        if(!$writer)
        {
            return redirect()->route('dashboard')->with('Error', 'Writer not found');
        }

        return view('dashboard', ['writer' => $writer]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Edit view for admin
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

            if(Writer::where('id', $id)->exists())
            {
                $writer = new Writer();
                $writer->name = $request->input('name', $writer->name);
                $writer->birth_date = $request->input('birth_date', $writer->birth_date);
                $writer->death_date = $request->input('death_date', $writer->death_date);

                if ($request->hasFile('profile_picture'))
                {
                    $path = $request->file('profile_picture')->store('profilePic', 'public');
                    $writer->profile_picture = $path;
                }

                $writer->save();

                return redirect()->route('dashboard')->with('success', 'Writer updated successfully');
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
        if(Writer::where('id', $id)->exists()){

            $writer = Writer::find($id);
            $writer->delete();

            return redirect()->route('writer.dashboard', $writer->id)->with('success', 'Writer deleted successfully');
        } else {
            return redirect()->back()-with('error', 'Could not delete writer');
        }
    }
}
