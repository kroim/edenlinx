<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        var_dump(Auth::user()->userrole);
        if(Auth::user()->userrole == 'admin'){
            var_dump('Not Found This Pages');
            Auth::logout();
            Session::flush();
            return redirect('/');
        }elseif (Auth::user()->userrole == 'customer'){
//            return redirect('/customer');
            var_dump('Not Found This Pages');
            Auth::logout();
            Session::flush();
            return redirect('/');
        }elseif (Auth::user()->userrole == 'business'){
            return redirect('/business');
        }else{
            return 'Not Found This Pages';
        }
//        return view('home');
    }
    public function adminlogout(){
        Auth::logout();
        Session::flush();
        return redirect('/admin-area');
    }
    public function businesslogout(){
        Auth::logout();
        Session::flush();
        return redirect('/');
    }
    public function customerlogout(){
        Auth::logout();
        Session::flush();
        return redirect('/');
    }

}
