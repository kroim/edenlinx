<?php

namespace myapp\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('front/project', array('title' => 'My Projects'));
    }
}
