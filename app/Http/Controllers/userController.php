<?php

namespace App\Http\Controllers;

use App\Models\city;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class userController extends Controller
{
    public function add_user(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $name = $request->name;
        $name_roles = $request->name_roles;

        $data = User::where('email',$email)->get('email');
        $e = '[{"email":"'.$email.'"}]';
        if($data != $e){
            $user = new User();
            $user->email = $email;
            $user->password = Hash::make($password);
            $user->name = $name;
            $user->user_id = 'IT-KH00';
            $user->name_roles = $name_roles;
            $user->save();
            
            $get = User::where('user_id', 'IT-KH00');
            $id = $get->get('id');
            $str = strlen($id);
            if($str == 10){ $sub = substr($id,7,1); }
            elseif($str == 11){ $sub = substr($id,7,2); }
            elseif($str == 12){ $sub = substr($id,7,3); }
            elseif($str == 13){ $sub = substr($id,7,4); }
            else{ $sub = substr($id,7,5); }

            if($name_roles == 'manager'){ $us = 'IT-MANAGER0'.$sub; }
            elseif($name_roles == 'staff'){ $us = 'IT-STAFF0'.$sub; }
            else{ $us = 'IT'.time().'-KH0'.$sub; }

            User::where('id',$sub)->update(['user_id'=>$us]);
            session()->flash('user_sc', $email);
            return redirect(route('user_dashboard'));
        }else{
            if($data == $e){
                session()->flash('user-er', 'Đăng ký không thành công');
                return redirect(route('user_dashboard'));
            }else{
                session()->flash('user-er', 'Đăng ký thất bại');
                return redirect(route('user_dashboard'));
            }
        }
    }
    public function update_list_user(Request $request)
    {
        $user_id = $request->user_id;
        $email = $request->email;
        $name = $request->name;
        $name_roles = $request->name_roles;
        $sex_user = $request->sex_user;
        $date_user = Carbon::parse($request ->date_user)->format('Y-m-d');
        $province = $request->province;
        $city = $request->city;
        $district = $request->district;
        $phone = $request->phone;

        $update = User::find($request->id);
        $update->user_id = $user_id;
        $update->email = $email;
        $update->name = $name;
        $update->name_roles = $name_roles;
        $update->sex_user = $sex_user;
        $update->date_user = $date_user;
        $update->province = $province;
        $update->city = $city;
        $update->district = $district;
        $update->phone = $phone;
        $update->save();

        session()->flash('update_user_sc', $email);
        return redirect(route('list_user_dashboard'));
    }
    
    public function update_profile_user(Request $request)
    {
        $email = $request->email;
        $name = $request->name;
        $date_user = Carbon::parse($request ->date_user)->format('Y-m-d');
        $update = User::find($request->id);
        $update->email = $email;
        $update->name = $name;
        $update->name_roles = $request->name_roles;
        $update->date_user = $date_user;
        if($request->hasFile('image')){
            $destination = 'dashboard/upload_img/user/'.Auth::user()->image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $request -> file('image');
            $name_file = $file -> getClientOriginalName();
            $filename = $name.'_'.$request->id.'_'.$name_file;
            $file -> move('dashboard/upload_img/user/',$filename);
            $update -> image = $filename;
        }
        $update->save();
        
        session()->flash('update_user_sc', $email);
        return redirect(route('edit_profile_user'));
    }
    public function update_profile_adress_user(Request $request)
    {
        $email = $request->email;
        $name = $request->name;
        $date_user = Carbon::parse($request ->date_user)->format('Y-m-d');
        $update = User::find($request->id);
        $update->email = $email;
        $update->name = $name;
        $update->name_roles = $request->name_roles;
        $update->sex_user = $request->sex_user;
        $update->date_user = $date_user;
        $update->phone = $request->phone;
        $update->district = $request->district;
        $update->city = $request->city;
        $update->province = $request->province;
        if($request->hasFile('image')){
            $destination = 'dashboard/upload_img/user/'.Auth::user()->image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $request -> file('image');
            $name_file = $file -> getClientOriginalName();
            $filename = $name.'_'.$request->id.'_'.$name_file;
            $file -> move('dashboard/upload_img/user/',$filename);
            $update -> image = $filename;
        }
        $update->save();

        session()->flash('update_user_sc', $email);
        return redirect(route('edit_profile_user'));
    }
    public function destroy_user(Request $request)
    {
        User::find($request->id)->delete();
        session()->flash('user_ds', 'Xóa thành công');
        return back();
    }
}
