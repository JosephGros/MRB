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
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (Auth::user()->role === 0 || Auth::user()->role === 1)
        {
            return view('admin.admin-dashboard');
        }
    }

    public function admin($type)
    {
        $items = [];

        if (Auth::user()->role === 0)
        {
            $items =  User::all();
            $items = $items->sortByDesc('created_at');
            
            return view('admin.userView', compact('items', 'type'));
        }
        
        return redirect()->back()->with('error', 'You are not authorized to do this.');
    }


    public function moderator($type)
    {
        $items = [];

        if (Auth::user()->role === 0 || Auth::user()->role === 1)
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
                case 'reviews':
                    $items = Review::all();
                    break;    
                default:
                    
            }

            $items = $items->sortByDesc('created_at');
            return view('admin.index', compact('items', 'type'));

        }

        return redirect()->back()->with('error', 'You are not authorized to do this.');

    }
}
