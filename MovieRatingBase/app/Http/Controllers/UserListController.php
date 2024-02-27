<?php

namespace App\Http\Controllers;

use App\Models\userList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userLists = Auth::user()->userLists;
        $allUserLists = [];

        foreach($userLists as $userList)
        {
            $listContent = $this->fetchListContent($userList->id);
            $recent = array_slice($listContent, 0, 20);
            $allUserLists[] = [
                'list' => $userList,
                'content' => $recent,
            ];
        }

        usort($allUserLists, function ($a, $b)
        {
            return $a['list']->created_at <=> $b['list']->created_at;
        });

        return view('profile', compact('allUserLists'));
    }

    private function fetchListContent($listId)
    {
        $userId = Auth::id();
        $listContent = userList::where('user_id', $userId)->findOrFail($listId);
        $userList = $listContent->userListContent;

        usort($userList, function ($a, $b)
        {
            return $a->added <=> $b->added;
        });

        return $userList;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string',
            ]);

        $userList = new userList();
        $userList->name = $request->name;
        $userList->user_id = Auth::id();
        $userList->save();

        return back()->with('success', 'List created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($listId)
    {
        $listContent = $this->fetchListContent($listId);

        return view('userList.show', compact('listContent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $listId)
    {
        $request->validate(
            [
                'name' => 'required|string',
            ]);

        $userList = userList::findOrFail($listId);

        if(Auth::id() !== $userList->user_id)
        {
            return back()->with('error', 'You are not authorized to update this list.');
        }

        $userList->name = $request->name;
        $userList->save();

        return back()->with('success', 'List name updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($listId)
    {
        $userList = userList::findOrFail($listId);

        if(Auth::id() !== $userList->user_id)
        {
            return back()->with('error', 'You are not authorized to delete this list.');
        }

        $userList->delete();

        return redirect()->route('profile')->with('success', 'The list is now deleted!');
    }
}
