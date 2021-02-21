<?php

namespace myapp\Http\Controllers;

use Illuminate\Http\Request;
use myapp\Http\Requests;
use Illuminate\Support\Facades\Auth;
use DB;
use Carbon\Carbon;
class BusinessController extends Controller
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
        $package = DB::table('users')->where('id',Auth::id())->value('package');
        $packageList = DB::table('business')->where('userid',Auth::id())->get();
        $package_num = 0;
        foreach($packageList as $packageItme){
            $package_num ++;
        }
        return view('backend/business', array('title' => 'Business Listing', 'package'=>$package, 'packageNum'=>$package_num));
    }
    public function savebusiness(Request $request){
        $file = $request->file('business_image');
        $extention = $file->getClientOriginalExtension();
        $filename = $file->getClientOriginalName();
        $destinationPath = 'uploads\\'.Auth::user()->email.'\\business';
        $file->move($destinationPath, $filename);
        $filepath = $destinationPath.'\\'.$filename;
//        echo $filepath;
//        echo '</br>';
//        echo $request['business_category'];
        $openinghours = '';
        if($request->has($request['o_moday'])){
            $input = array('o_mon'=>$request['o_monday'],'c_mon'=>$request['c_monday'],'o_tue'=>$request['o_tuesday'],'c_tue'=>$request['c_tuesday'],
                'o_wed'=>$request['o_wednesday'],'c_wed'=>$request['c_wednesday'],'o_thu'=>$request['o_thursday'],'c_thu'=>$request['c_thursday'],
                'o_fri'=>$request['o_friday'],'c_fri'=>$request['c_friday'],'o_sat'=>$request['o_saturday'],'c_sat'=>$request['c_saturday'],
                'o_sun'=>$request['o_sunday'],'c_sun'=>$request['c_sunday']);
            $openinghours = implode(', ', array_map(
                function ($v, $k) {
                    if(is_array($v)){
                        return $k.'[]='.implode('&'.$k.'[]=', $v);
                    }else{
                        return $k.'='.$v;
                    }
                },
                $input,
                array_keys($input)
            ));
        }
//        var_dump(explode(',', $openinghours));
        DB::table('business')->insert(['userid'=>Auth::id(),'b_title'=>$request['business_title'],'b_category'=>$request['business_category'],
        'b_keyword'=>$request['business_keywords'],'state'=>$request['business_state'],'city'=>$request['business_city'],'address'=>$request['business_address'],
            'postcode'=>$request['business_zipcode'],'b_image'=>$filepath,'b_description'=>$request['business_description'],
            'b_phone'=>$request['business_phone'],'b_website'=>$request['business_website'],'b_email'=>$request['business_email'],'openinghours'=>$openinghours]);
        return redirect('business');
    }
    public function saveReview(Request $request){
        if($request['rating'] == null){
            $rating = 0;
        }else{
            $rating = 6 - intval($request['rating']);
        }
        $current_time = Carbon::now()->toDateString();
        var_dump($current_time);
        DB::table('review')->insert(['r_bid'=>intval($request['r_bid']),'r_name'=>$request['r_name'],'r_email'=>$request['r_email'],
            'r_review'=>$request['r_review'],'r_rating'=>$rating,'r_image'=>$request['r_image'],'r_created_at'=>$current_time]);
        return redirect()->back();
    }
}
