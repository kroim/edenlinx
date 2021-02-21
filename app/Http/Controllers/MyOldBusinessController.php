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
        if($res1 == null){
            $b_check = 'true';
        }

        return view('businesspage/business', array('title' => 'Business Listing', 'package'=>$package, 'b_check'=>$b_check));
    }
    public function savebusiness(Request $request){
        $file = $request->file('business_image');
        $extention = $file->getClientOriginalExtension();
        $filename = Auth::user()->email.'.'.$extention;
        $destinationPath = 'uploads/business';
        $file->move($destinationPath, $filename);
        $filepath = $destinationPath.'/'.$filename;
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
        $address = $request['business_zipcode'];
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($address)."&sensor=false";
        $json1 = file_get_contents($url);
        $json = json_decode($json1);
//        var_dump($json);
        $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
        $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
//        var_dump($lat, $long);
//        var_dump(explode(',', $openinghours));
        DB::table('business')->insert(['userid'=>Auth::id(),'b_title'=>$request['business_title'],'b_category'=>$request['business_category'],
            'b_keyword'=>$request['business_keywords'],'state'=>$request['business_state'],'city'=>$request['business_city'],'address'=>$request['business_address'],
            'postcode'=>$request['business_zipcode'],'b_image'=>$filepath,'b_description'=>$request['business_description'],
            'b_phone'=>$request['business_phone'],'b_website'=>$request['business_website'],'b_email'=>$request['business_email'],'openinghours'=>$openinghours,
            'latitude'=>$lat,'longitude'=>$long,'update'=>'false']);
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
        $extention = $file->getClientOriginalExtension();
        $filename = Auth::user()->email.'.'.$extention;
        $destinationPath = 'uploads/profile';
        $file->move($destinationPath, $filename);
        $filepath = $destinationPath.'/'.$filename;
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
