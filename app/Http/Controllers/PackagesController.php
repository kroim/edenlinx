<?php

namespace myapp\Http\Controllers;

use Illuminate\Http\Request;

class PackagesController extends Controller
{
    //
    public function index(){
        return view('backend/packages', ['title'=>'Listing Packages']);
    }
}
