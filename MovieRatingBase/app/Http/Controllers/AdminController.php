<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Creator;
use App\Models\Director;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Review;
use App\Models\Serie;
use App\Models\User;
use App\Models\Writer;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($type)
    {
        switch ($type)
        {
            case 'movies':
                $items = Movie::all();
                break;
            case 'series':
                $items = Serie::all();
                break;
            case 'genres':
                $items = Genre::all();
                break;
            case 'actors':
                $items = Actor::all();
                break;
            case 'directors':
                $items = Director::all();
                break;
            case 'creators':
                $items = Creator::all();
                break;
            case 'writers':
                $items = Writer::all();
                break;
            case 'users':
                $items = User::all();
                break;
            case 'reviews':
                $items = Review::all();
                break;
            default:
                $items = [];
        }

        usort($items, function ($a, $b)
        {
            return strcmp($b->created_at, $a->created_at);
        });
        

        return view('admin.index', compact('items', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
