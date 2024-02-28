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
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (Auth::user()->role === 0 || Auth::user()->role === 1)
        {
            return view('admin.admin-dashboard');
        }
    }

    public function adminAll($type)
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


    public function moderatorAll($type)
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
            return view('admin.adminIndex', compact('items', 'type'));

        }

        return redirect()->back()->with('error', 'You are not authorized to do this.');

    }

    public function promoteUser(Request $request, $userId)
    {
        if (Auth::user()->role === 0)
        {
            $user = User::findOrFail($userId);
            $user->role = $request->role;
            $user->save();

            return view('admin.userView')->with('success', 'User promoted successfully!');
        }

        return back()->with('error', 'You are not authorized to do this.');
    }

    public function deleteUser(Request $request, $userId)
    {
        if (Auth::user()->role === 0)
        {
            if ($request->password !== $request->confirm_password)
            {
                return back()->with('error', 'Passwords do not match!');
            }

            if (!Hash::check($request->password, Auth::user()->password))
            {
                return back()->with('error', 'Incorrect admin password');
            }

            $user = User::findOrFail($userId);
            $user->delete();

            return view('admin.userView')->with('success', 'User deleted successfully!');
        }

        return back()->with('error', 'You are not authorized to do this.');
    }

    public function viewUser($userId)
    {
        if (Auth::user()->role === 0)
        {
            $user = User::findOrFail($userId);


            return view('admin.editUsers', compact('user'));
        }

        return back()->with('error', 'You are not authorized to do this.');
    }

    // //Get all functions

    // public function getAllGenres()
    // {
    //     if (Auth::user()->role === 0 || Auth::user()->role === 1)
    //     {
    //         $genres = Genre::all();

    //         return view('admin.adminIndex', compact('genres'));
    //     }

    //     return back()->with('error', 'You are not authorized to do this.');
    // }

    // public function getAllReviews()
    // {
    //     if (Auth::user()->role === 0 || Auth::user()->role === 1)
    //     {
    //         $reviews = Review::all();

    //         return view('admin.adminIndex', compact('reviews'));
    //     }

    //     return back()->with('error', 'You are not authorized to do this.');
    // }
}
