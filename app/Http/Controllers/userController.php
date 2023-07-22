<?php

namespace App\Http\Controllers;

use App\Models\city;
use App\Models\User;
use App\Models\history;
use App\Models\luong;
use App\Models\user_famous;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class userController extends Controller
{
    public function add_user(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6',
            'check_password' =>  'required|same:password',
            
        ], [
            'name.required' => 'Không được để trống',
            'email.required' => 'Không được để trống',
            'password.required' => 'Không được để trống',
            'password.min' => 'Tối thiểu 6 ký tự',
            'check_password.required' => 'Nhập lại mật khẩu không chính xác',
            'check_password.same' => 'Nhập lại mật khẩu không chính xác',
            
        ]);
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
            if($str == 10){ 
                $sub = substr($id,7,1); 
            }elseif($str == 11){ 
                $sub = substr($id,7,2); 
            }elseif($str == 12){ 
                $sub = substr($id,7,3); 
            }elseif($str == 13){ 
                $sub = substr($id,7,4); 
            }else{ 
                $sub = substr($id,7,5); 
            }

            if($name_roles == 'manager'){ 
                $us = 'IT-MANAGER0'.$sub; }
            elseif($name_roles == 'staff'){ 
                $us = 'IT-STAFF0'.$sub; }
            else{ 
                $us = 'IT'.time().'-KH0'.$sub; }

            User::where('id',$sub)->update(['user_id'=>$us]);
            history::create([
                'name_his'=>'Create',
                'user_his'=>Auth::user()->email.'-'.Auth::user()->name_roles,
                'description_his'=>'tạo người dùng :'.$request->email
            ]);
            // if($name_roles == 'staff' or $name_roles == 'manager'){
            //     $luong = new luong();
            //     $luong->user_id = $us;
            //     $luong->user_name = $name;
            //     $luong->name_roles = $name_roles;
            //     if($name_roles == 'manager'){
            //         $luong->salary = '35000';
            //     }else{
            //         $luong->salary = '23000';
            //     }
            //     $luong->save();
            // }
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
        $update->name_status = $request->name_status;
        $update->save();

        history::create([
            'name_his'=>'Update',
            'user_his'=>Auth::user()->email.'-'.Auth::user()->name_roles,
            'description_his'=>'cập nhật người dùng :'.$request->email
        ]);

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
        history::create([
            'name_his'=>'Update',
            'user_his'=>Auth::user()->email.'-'.Auth::user()->name_roles,
            'description_his'=>'cập nhật người dùng :'.$request->email
        ]);
        
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

        history::create([
            'name_his'=>'Update',
            'user_his'=>Auth::user()->email.'-'.Auth::user()->name_roles,
            'description_his'=>'cập nhật địa chỉ người dùng :'.$email
        ]);

        session()->flash('update_user_sc', $email);
        return redirect(route('edit_profile_user'));
    }
    public function destroy_user(Request $request)
    {
        User::find($request->id)->delete();
        $get_us = User::all()->where('id',$request->id);
        foreach($get_us as $get_u){
            user_famous::where('user_id',$get_u->user_id)->delete();
        }
        history::create([
            'name_his'=>'Destroy',
            'user_his'=>Auth::user()->email.'-'.Auth::user()->name_roles,
            'description_his'=>'xóa người dùng : id-'.$request->id
        ]);
        session()->flash('user_ds', 'Xóa thành công');
        return back();
    }

    public function reset_pw(Request $request)
    {
        User::where('id',$request->id)->update([
            'password'=>Hash::make('123456')
        ]);
        history::create([
            'name_his'=>'Reset-PW',
            'user_his'=>Auth::user()->email.'-'.Auth::user()->name_roles,
            'description_his'=>'Reset mật khẩu : id-'.$request->id
        ]);
        session()->flash('reset_pw', 'Đặt lại mật khẩu thành công');
        return back();
    }
    public function reset_pass_with_user(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6',
            'check_password' =>  'required|same:password',
        ],[
            'password.required' => '* Bạn chưa nhập mật khẩu',
            'password.min' => '* Mật khẩu tối thiểu 6 ký tự',
            'check_password.required' => '* Bạn chưa nhập mật khẩu',
            'check_password.same' => '* Nhập lại mật khẩu không chính xác',
        ]);
        $id = Auth::user()->id;
        $old = $request->old_password;
        $pass = $request->password;
        $ps = Auth::user()->password;
        if(Hash::check($old,$ps)){
            User::where('id', $id)->update(['password'=>Hash::make($pass)]);
            session()->flash('reset_pw_wu', 'Đổi mật khẩu thành công');
        }else{
            session()->flash('reset_pw_wu_er', 'Mật khẩu hiện tại không chính xác');
        }
        return back();
    }
}
