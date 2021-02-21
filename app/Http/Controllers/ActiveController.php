<?php

namespace myapp\Http\Controllers;

use Illuminate\Http\Request;

class ActiveController extends Controller
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
        return view('backend/active', array('title' => 'Active Projects'));
    }
}
