<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserListContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function toggle(Request $request)
    {
        $request->validate(
            [
                'user_list_ids' => 'required|array',
                'user_list_ids' => 'exists:user_lists_id',
                'media_id' => 'required',
                'media_type' => 'required|in:movie,serie',
            ]);

        $action = $request->has('add_to_lists') ? 'add' : ($request->has('remove_from_lists') ? 'remove' : null);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
