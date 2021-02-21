<?php

namespace myapp\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $businesses = DB::table('business')->get();
//        var_dump($businesses[0]->b_category);
        return view('welcome',array('businesses'=>$businesses));
    }
    public function getBusiness($id){
        $business = DB::table('business')->where('b_id', $id)->first();
        $ratings = DB::table('review')->where('r_bid', $id)->get();
        $address = intval($business->postcode);
        $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false");
        $json = json_decode($json);
        $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
        $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
        $mapText = substr($business->b_title,0,2);
        $openhours = explode(',', $business->openinghours);
        $openingResult = [];
        foreach ($openhours as $openhour){
            $catch_open = explode('=', $openhour);
            array_push($openingResult, $catch_open[1]);
        }
        $countReview = 0;
        $avgReview = 0.0;
        $sum = 0;
        foreach($ratings as $rating){
            $countReview ++;
            $sum = $sum + $rating->r_rating;
        }
        if($countReview != 0){
            $avgReview = round(floatval($sum / $countReview),1);
        }
        return view('front/businessInfo',array('business'=>$business, 'lat'=>$lat, 'long'=>$long, 'mapText'=>$mapText, 'ratings'=>$ratings, 'openinghours'=>$openingResult,
            'countReview'=>$countReview, 'avgReview'=>$avgReview));
    }
}
