<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\contact;
class ContactController extends Controller
{
    
    public function store(Request $request)
    {
        // Validera formuläret
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        // Skapa en ny post i databasen med formulärdata
        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        // Redirecta användaren med ett framgångsmeddelande
        return back()->with('success', 'Ditt meddelande har skickats.');
    }
    
    public function index()
    {
        return view('contact');
    }
}
