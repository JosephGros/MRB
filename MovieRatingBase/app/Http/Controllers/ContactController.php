<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }
    // Visa kontaktformuläret
    public function create()
    {
        return view('contact'); // contact.blade.php
    }

    // Hantera inskickat formulär
    public function store(Request $request)
    {
        // Validera och processa data här
        // Exempel: Kontrollerar ifall rätt data är inmatad
         $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        // Processa data (t.ex. spara i databasen, skicka e-post, etc.)

        return redirect()->route('contact.create')->with('success', 'Ditt meddelande har skickats.');
    }
}
