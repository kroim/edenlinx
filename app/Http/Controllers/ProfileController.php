<?php

namespace myapp\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use myapp\Http\Requests;
use Illuminate\Support\Facades\Auth;
use DB;

class ProfileController extends Controller
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
    public function index(Request $request)
    {
        $id = Auth::user()->id;
        $userdata = DB::select('select * from users WHERE id = ?',[$id]);
        $name = $userdata[0] -> name;
        $phone = $userdata[0] -> userphone;
        $email = $userdata[0] -> email;
        $notes = $userdata[0] -> notes;
        $profileImage = $userdata[0] -> userprofile;
        $oldConfirm = true;
        $newConfirm = true;
        if($request->has('oldpwd')){
            $oldConfirm = false;
        }
        return view('backend/profile', array('title' => 'My Profile', 'profileImage' => $profileImage, 'name' => $name, 'phone' => $phone, 'email' => $email,
            'notes' => $notes, 'profileImage' => $profileImage, 'oldConfirm'=>$oldConfirm, 'newConfirm'=>$newConfirm));
    }
    public function uploadfile(Request $request){
        $file = $request->file('image');
        $extention = $file->getClientOriginalExtension();
        $filename = 'profile.'.$extention;
        $destinationPath = 'uploads\\'.Auth::user()->email;
        $file->move($destinationPath, $filename);
        $filepath = $destinationPath.'\\'.$filename;
        DB::update('update users set userprofile = ? where id = ?',[$filepath,Auth::user()->id]);
//        return view('profile', array('title' => 'My Profile', 'profileImage' => $destinationPath.'\\'.$filename));
        return redirect('profile');
    }
    public function saveprofile(Request $request){
        $file = $request->file('profile_image');
        $extention = $file->getClientOriginalExtension();
        $filename = 'profile.'.$extention;
        $destinationPath = 'uploads\\'.Auth::user()->email;
        $file->move($destinationPath, $filename);
        $filepath = $destinationPath.'\\'.$filename;
        $name = $request['name'];
        $phone = $request['phone'];
        $email = $request['email'];
        $notes = $request['notes'];
        $id = Auth::user()->id;
        DB::update('update users set name = ?, userphone = ?, email = ?, notes = ?, userprofile = ? WHERE id = ?',[$name, $phone, $email, $notes, $filepath, $id]);
        return redirect('profile');
    }
    public function resetpwd(Request $request){
        $old_pwd = $request['oldpwd'];
        if(!Hash::check($old_pwd, Auth::user()->getAuthPassword())){
            return redirect('profile')->with('oldpwd', 'false');
        }
        else{
            $this->validate($request,[
//            'oldpwd'=>'exists:users,password',
                'newpwd'=>'confirmed'
            ]);
            $newpassword =  Hash::make($request['newpwd']);
            DB::update('update users set password = ? WHERE id = ?',[$newpassword, Auth::id()]);
            return redirect('profile')->with(['success'=>'Reset password successfully'])->withInput();
        }
    }
}
