<?php

namespace App\Http\Controllers;

use App\Models\userList;
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
        $userLists = Auth::user()->userlist;
        return view('add_content_to_list', compact('userLists'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'user_lists_id' => 'exists:user_lists_id',
                'media_id' => 'required',
                'media_type' => 'required|in:movie,serie',
            ]);

        $userList = userList::findOrFail($request->user_lists_id);
        if(Auth::id() !== $userList->user_id)
        {
            return back()->with('error', 'You are not authorized to modify this list.');
        }

        $userListContent = new UserListContent();
        $userListContent->user_lists_id = $request->user_lists_id;
        $userListContent->media_id = $request->media_id;
        $userListContent->media_type = $request->media_type;
        $userListContent->save();

        return redirect()->back()->with('success', 'Item added to list successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->validate(
            [
                'user_lists_id' => 'exists:user_lists_id',
                'media_id' => 'required',
                'media_type' => 'required|in:movie,serie',
            ]);

        $userList = userList::findOrFail($request->user_lists_id);
        if(Auth::id() !== $userList->user_id)
        {
            return back()->with('error', 'You are not authorized to modify this list.');
        }

        UserListContent::where('user_lists_id', $request->user_lists_id)->where('media_id', $request->media_id)
        ->where('media_type', $request->media_type)->delete();

        return redirect()->back()->with('success', 'Item removed from list successfully!');
    }
}
