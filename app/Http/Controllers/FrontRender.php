<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontRender extends Controller
{
    /**
     * Display a listing of the project resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('projects.index', compact('projects'));
    }
}
