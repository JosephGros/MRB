<?php

namespace App\Http\Controllers;

use App\Models\UserList;
use App\Models\UserListContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserListContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Notera ändringen till camelCase för relationen
        $userLists = Auth::user()->userLists;
        return view('contentViews.add-content-list', compact('userLists'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_lists_id' => 'required|exists:user_lists,id', // Korrigerad exists-regel
            'media_id' => 'required',
            'media_type' => 'required|in:movie,serie',
        ]);

        $userList = UserList::findOrFail($request->user_lists_id);

        // Kontrollera att den inloggade användaren äger listan
        if (Auth::id() !== $userList->user_id) {
            return back()->with('error', 'You are not authorized to modify this list.');
        }

        UserListContent::create([
            'user_lists_id' => $request->user_lists_id,
            'media_id' => $request->media_id,
            'media_type' => $request->media_type,
        ]);

        return redirect()->back()->with('success', 'Item added to list successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'user_lists_id' => 'required|exists:user_lists,id',
            'media_id' => 'required',
            'media_type' => 'required|in:movie,serie',
        ]);

        $userList = UserList::findOrFail($request->user_lists_id);

        // Kontrollera återigen behörighet
        if (Auth::id() !== $userList->user_id) {
            return back()->with('error', 'You are not authorized to modify this list.');
        }

        UserListContent::where([
            ['user_lists_id', '=', $request->user_lists_id],
            ['media_id', '=', $request->media_id],
            ['media_type', '=', $request->media_type],
        ])->delete();

        return redirect()->back()->with('success', 'Item removed from list successfully!');
    }
}
