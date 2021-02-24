<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class BusinessController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $package = DB::table('users')->where('id',Auth::id())->value('package');
        $res1 = DB::table('business')->where('userid',Auth::id())->first();
        $b_check = 'false';
        if(!isset($res1->postcode)){
            $b_check = 'true';
        }
        if($res1 == null){
            $b_check = 'true';
            DB::table('business')->insert(['userid'=>Auth::id(), 'b_title'=>'Default Business', 'b_category'=>'Default Category', 'b_keyword'=>'Default',
                'b_image'=>'https://placehold.it/468x265?text=IMAGE', 'b_headerimage'=>'https://placehold.it/1200x400?text=IMAGE']);
            $res1 = DB::table('business')->where('userid',Auth::id())->first();
        }
        return view('businesspage/business', array('title' => 'Business Listing', 'package'=>$package, 'b_res'=>$res1, 'b_check'=>$b_check));
    }
    public function savebusiness(Request $request){
        $destinationPath = 'uploads/business';
        $res = DB::table('business')->where('userid',Auth::id())->first();
        if($request->file('business-main-img') != null){
            $file_main = $request->file('business-main-img');
            $extention_main = $file_main->getClientOriginalExtension();
            $filename_main = Auth::user()->email.'_main.'.$extention_main;
            //$file_main->move($destinationPath, $filename_main);
            $filepath_main = $destinationPath.'/'.$filename_main;
            $imgdata = $request['imgData'];
            $imgdata = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imgdata));
            file_put_contents($filepath_main, $imgdata);
        }elseif($res->b_image != null){
            $filepath_main = $res->b_image;
        }else{
            $filepath_main = "https://placehold.it/468x265?text=IMAGE";
        }
        if($request->file('business-listing-img') != null){
            $file_listing = $request->file('business-listing-img');
            $extention_listing = $file_listing->getClientOriginalExtension();
            $filename_listing = Auth::user()->email.'_listing.'.$extention_listing;
//            $file_listing->move($destinationPath, $filename_listing);
            $filepath_listing = $destinationPath.'/'.$filename_listing;
            $imgdata1 = $request['imgData1'];
            $imgdata1 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imgdata1));
            file_put_contents($filepath_listing, $imgdata1);
        }elseif($res->b_headerimage != null){
            $filepath_listing = $res->b_headerimage;
        }else{
            $filepath_listing = "https://placehold.it/1920x280?text=IMAGE";
        }

//        var_dump($filepath_listing);
//        var_dump($filepath_main);
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
//        $address = $request['business_zipcode'];
//        $location = DB::table('postcodes_geo')->where('postcode',$address)->first();
//        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($address)."&sensor=false";
//        $json1 = file_get_contents($url);
//        $json = json_decode($json1);
//
////        var_dump($json);
//        $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
//        $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
        $str1 = $request['business_address'];
        $str2 = $request['business_city'];
        $str3 = $request['business_state'];
        $str_res = $str1.' '.$str2.' '.$str3;
        $location = str_replace(' ', '+', $str_res);
        $geo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$location.'&sensor=false');
        $geo = json_decode($geo, true);
        if ($geo['status'] == 'OK') {
            // Get Lat & Long
            $lat = $geo['results'][0]['geometry']['location']['lat'];
            $long = $geo['results'][0]['geometry']['location']['lng'];
        }else{
            $lat = -33.8063202;
            $long = 151.0055087;
        }
        DB::update('update business set b_title = ?, b_category = ?, b_keyword = ?, state = ?, city = ?, address = ?, postcode = ?,
            b_image = ?, b_headerimage = ?, b_description = ?, b_phone = ?, b_website = ?, b_email = ?, openinghours = ?, latitude = ?, longitude = ?, bupdate = ? WHERE userid = ?', [$request['business_title'],
            $request['business_category'], $request['business_keywords'], $request['business_state'], $request['business_city'], $request['business_address'], $request['business_zipcode'],
            $filepath_main, $filepath_listing, $request['business_description'], $request['business_phone'], $request['business_website'], $request['business_email'], $openinghours,
            $lat, $long, 'false', Auth::id()]);
//        var_dump($lat, $long);
//        var_dump(explode(',', $openinghours));
//        DB::table('business')->insert(['userid'=>Auth::id(),'b_title'=>$request['business_title'],'b_category'=>$request['business_category'],
//            'b_keyword'=>$request['business_keywords'],'state'=>$request['business_state'],'city'=>$request['business_city'],'address'=>$request['business_address'],
//            'postcode'=>$request['business_zipcode'],'b_image'=>$filepath,'b_description'=>$request['business_description'],
//            'b_phone'=>$request['business_phone'],'b_website'=>$request['business_website'],'b_email'=>$request['business_email'],'openinghours'=>$openinghours,
//            'latitude'=>$lat,'longitude'=>$long,'update'=>'false']);
        return redirect('business');
    }
    public function profile(){
        $id = Auth::user()->id;
        $userdata = DB::select('select * from users WHERE id = ?',[$id]);
        $name = $userdata[0] -> name;
        $phone = $userdata[0] -> userphone;
        $email = $userdata[0] -> email;
        $notes = $userdata[0] -> notes;
        $profileImage = $userdata[0] -> userprofile;

        return view('businesspage/profile', array('title' => 'My Profile', 'profileImage' => $profileImage, 'name' => $name, 'phone' => $phone, 'email' => $email,
            'notes' => $notes, 'profileImage' => $profileImage));
    }
    public function saveprofile(Request $request){
        $file = $request->file('profile_image');
        if(isset($file)){
            $extention = $file->getClientOriginalExtension();
            $filename = Auth::user()->email.'.'.$extention;
            $destinationPath = 'uploads/profile';
            $file->move($destinationPath, $filename);
            $filepath = $destinationPath.'/'.$filename;
        }
        else{
            $filepath = 'images/boy-256.png';
        }
//        $extention = $file->getClientOriginalExtension();
//        $filename = Auth::user()->email.'.'.$extention;
//        $destinationPath = 'uploads/profile';
//        $file->move($destinationPath, $filename);
//        $filepath = $destinationPath.'/'.$filename;
        $name = $request['name'];
        $phone = $request['phone'];
        $email = $request['email'];
        $notes = $request['notes'];
        $id = Auth::user()->id;
        DB::update('update users set name = ?, userphone = ?, email = ?, notes = ?, userprofile = ? WHERE id = ?',[$name, $phone, $email, $notes, $filepath, $id]);
        return redirect('business/profile');
    }
    public function resetprofile(Request $request){
        $old_pwd = $request['oldpwd'];
        if(!Hash::check($old_pwd, Auth::user()->getAuthPassword())){
            return redirect('business/profile')->with('oldpwd', 'false');
        }
        else{
            $this->validate($request,[
//            'oldpwd'=>'exists:users,password',
                'newpwd'=>'confirmed'
            ]);
            $newpassword =  Hash::make($request['newpwd']);
            DB::update('update users set password = ? WHERE id = ?',[$newpassword, Auth::id()]);
            return redirect('business/profile')->with(['success'=>'Reset password successfully'])->withInput();
        }
    }
    public function dashboard(){
        return view('businesspage/dashboard', array('title' => 'Dashboard'));
    }

    public function package(){
        $package = DB::table('users')->where('id',Auth::id())->value('package');
        return view('businesspage/packages', ['title'=>'Listing Packages', 'package'=>$package]);
    }
    public function setpackage($name){
        var_dump($name);
        DB::update('update users set package = ? where id = ?',[$name, Auth::id()]);
        return redirect('/business/packages');
    }
}
