<?php

namespace myapp\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
    public function index(){
        return view('front/contact');
    }
}
