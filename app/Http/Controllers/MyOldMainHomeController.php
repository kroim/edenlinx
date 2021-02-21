<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class MainHomeController extends Controller
{
    //
    public function index(){
        $businesses = DB::table('business')->where('update', 'true')->get();
//        var_dump($businesses[0]->b_category);
        return view('welcome',array('businesses'=>$businesses));
    }
    public function getBusiness($id){
        $business = DB::table('business')->where('b_id', $id)->first();
        $ratings = DB::table('review')->where('r_bid', $id)->get();
        $address = $business->postcode;
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($address)."&sensor=false";
        $json1 = file_get_contents($url);
        $json = json_decode($json1);
//        var_dump($json);
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
        return view('businessInfo',array('business'=>$business, 'lat'=>$lat, 'long'=>$long, 'mapText'=>$mapText, 'ratings'=>$ratings, 'openinghours'=>$openingResult,
            'countReview'=>$countReview, 'avgReview'=>$avgReview));
    }

    public function searchCategroy(Request $request){
        $categoryName = $request->get('categoryName');
        $postalCode = $request->get('postalCode');

        if($categoryName ==''){
            $countSql = DB::table('business');
            $businessSql = DB::table('business');
        }else{
            $countSql = DB::table('business')->where('b_title', 'like', '%'.$categoryName.'%');
            $businessSql = DB::table('business')->where('b_title', 'like', '%'.$categoryName.'%');
        }

        if($postalCode != ''){
            $countSql = $countSql->where('postcode','like','%'.$postalCode.'%');
            $businessSql = $businessSql->where('postcode','like','%'.$postalCode.'%');
        }

        $count = $countSql->count();
        $business = $businessSql->paginate(4);
        $business->appends('categoryName',$categoryName);
        $business->appends('postalCode',$postalCode);

        return view('category',['business'=>$business, 'totalCount'=>$count,'categoryName'=>$categoryName,'postalCode'=>$postalCode]);
    }

    public function displayCategory(Request $request){
        $business = DB::table('business')->paginate(4);
        $count = DB::table('business')->count();
        return view('category',['business'=>$business, 'totalCount'=>$count]);
    }
}
