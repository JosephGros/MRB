<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    /**
     * Visar About us sida
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('about-us');
    }
}
