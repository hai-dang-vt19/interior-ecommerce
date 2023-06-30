<?php

namespace App\Http\Controllers;

use App\Models\city;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\history;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use App\Jobs\DemoEmail;

class interiorPostController extends Controller
{
     //------------------------------------------ dash board -----------------------------------------
     //------------------------------------------ login -----------------------------------------
     public function login_interior(Request $request)
     {
        if(!empty($request->remember_token)){
            $remember = $request->remember_token;
        }else{
            $remember = "0";
        }
        
        $check_space_pass = strpos($request->password, ' ');
        $check_space_email = strpos($request->email, ' ');
        if ($check_space_pass == true) {
            session()->flash('login-er','Mật khẩu không được nhập khoảng trắng');
            return back();
        }
        if ($check_space_email == true) {
            session()->flash('login-er','Email không được nhập khoảng trắng');
            return back();
        }
        $request->validate([
            'email' => 'required|max:100',
            'password' => 'required|min:6|max:30'
        ],[
            'email.required'=>'Vui lòng điền vào trường này',
            'email.max'=>'Quá số lượng ký tự',
            'password.required'=>'Vui lòng điền vào trường này',
            'password.max'=>'Quá số lượng ký tự',
            'password.min'=>'Nhập tối thiểu 6 ký tự'
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials,$remember)) {
            $request->session()->regenerate();
            // dd($request->all());
            if (Auth::check()) {
                if(Auth::user()->name_status == 1){
                    if(Auth::user()->name_roles == 'user'){
                        session()->flash('success', 'Đăng nhập thành công')    ;
                        return redirect(route('index'));
                    }elseif(Auth::user()->name_roles == 'admin'){
                        session()->flash('login-sc', 'Đăng nhập thành công');
                        return redirect(route('index_dashboard'));
                    }else{
                        session()->flash('login-sc', 'Đăng nhập thành công');
                        return redirect(route('bill_dashboad'));
                    }
                }else{
                    session()->flash('login-er', 'Tài khoản đã ngắt kết nối, để sử dụng lại bạn hãy liên hệ chúng tôi');
                    return redirect(route('login'));
                }                
            } else {
                session()->flash('login-er', 'Không thành công');
                return redirect(route('login'));
            }  
        }else{
            session()->flash('login-er', 'Tài khoản hoặc mật khẩu không chính xác');
            return redirect(route('login'));
        }
     }
     public function register_interior(Request $request)
     {
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|max:100',
            'password' => 'required|min:6|max:30',
            'check_password' =>  'required|same:password',
        ], [
            'name.required' => 'Vui lòng điền vào trường này',
            'name.max'=>'Quá số lượng ký tự',
            'email.required' => 'Vui lòng điền vào trường này',
            'email.max'=>'Quá số lượng ký tự',
            'password.required' => 'Vui lòng điền vào trường này',
            'password.min' => 'Nhập tối thiểu 6 ký tự',
            'password.max'=>'Quá số lượng ký tự',
            'check_password.required' => 'Vui lòng điền vào trường này',
            'check_password.same' => 'Nhập lại mật khẩu không chính xác',
        ]);
        $email = $request->email;
        $password = $request->password;
        $name = $request->name;

        $data = User::where('email',$email)->get('email');
        $e = '[{"email":"'.$email.'"}]';
        if($data != $e){
            $user = new User();
            $user->email = $email;
            $user->password = Hash::make($password);
            $user->name = $name;
            $user->user_id = 'IT-KH00';
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
            $us = 'IT'.time().'-KH0'.$sub;
            User::where('id',$sub)->update(['user_id'=>$us]);

            history::create([
                'name_his'=>'Create',
                'user_his'=>'New '.$email,
                'description_his'=>'Người dùng đăng ký thài khoản :'.$email
            ]);

            session()->flash('register-sc','Đăng ký thành công');
            return redirect(route('login'));
        }else{
            if($data == $e){
                session()->flash('register-er', 'Email này đã được sử dụng');
                return redirect(route('register'));
            }else{
                session()->flash('register-er', 'Đăng ký thất bại');
                return redirect(route('register'));
            }
        }
     }
     public function logout()
     {
        if(Auth::user()->name_roles == 'user'){
            Auth::logout();
            return redirect(route('index'));
        }else{
            Auth::logout();
            return redirect(route('login'));
        }
     }
    //  public function logout_interior()
    //  {
    //     Auth::logout();
    //     return redirect(route('index'));
    //  }
     
     //------------------------------------------   client   -----------------------------------------
     public function sendmail(Request $request)
     {
        $data['title'] = $request->email_user;
        $data['content'] = $request->content;
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['check'] = $request->check;
        $email = $request->email;
        DemoEmail::dispatch($data, $email);
        // \App\Jobs\DemoEmail::dispatch($data, $request->email)->delay(now()->addSeconds(2));
        session()->flash('msg', 'Gửi mail thành công');
        return redirect(route('contact'));
     }
     
    //  public function update_profile_city_cart(Request $request)
    //  {
    //     User::where('id',$request->id)->update([
    //         'district'=>$request->district,
    //         'city'=>$request->city,
    //         'province'=>$request->province
    //     ]);
    //     session()->flash('update_sc', 'Cập nhật thành công');
    //     return redirect()->route('cart');
    //  }
    //  public function update_profile_city(Request $request)
    //  {
    //     $provinces = city::all()->where('name_city',$request->city);
    //     foreach($provinces as $pro){
    //         User::where('id',$request->id)->update([
    //             'email'=>$request->email,
    //             'name'=>$request->name,
    //             'sex_user'=>$request->sex_user,
    //             'date_user'=>$request->date_user,
    //             'phone'=>$request->phone,
    //             'city'=>$request->city,
    //             'district'=>$request->district,
    //             'province'=>$pro->city_province
    //         ]);
    //     }
    //     session()->flash('update_sc', 'Cập nhật thành công');
    //     return redirect()->route('profile_user');
    //  }
     public function update_password(Request $request)
     {
        $request->validate([
            'pass_old' => 'required',
            'pass_new' => 'required|min:6|max:30',
            'check_pass_new' =>  'required|same:pass_new',
        ], [
            'pass_old.required' => 'Vui lòng điền vào trường này',
            'pass_new.required' => 'Vui lòng điền vào trường này',
            'pass_new.min' => 'Nhập tối thiểu 6 ký tự',
            'pass_new.max' => 'Quá số lượng ký tự',
            'check_pass_new.required' => 'Vui lòng điền vào trường này',
            'check_pass_new.same' => 'Nhập lại mật khẩu không chính xác',
        ]);
        
        $pass_old = $request->pass_old;
        $pass_new = $request->pass_new;
        $get_info = User::where('email',Auth::user()->email);
        $old_pass = Auth::user()->password;
        if(Hash::check($pass_old, $old_pass)){
            $get_info->update(['password'=>Hash::make($pass_new)]);
            session()->flash('success', 'Đổi mật khẩu thành công');
        }else{
            session()->flash('warning', 'Mật khẩu cũ không chính xác');
        }
        return back();
     }

     public function update_profile(Request $request){
        $name = $request->name;
        $email = $request->email;
        $sex = $request->sx_us;
        $date = Carbon::parse($request->date)->toDateString();
        $phone = $request->phone;
        $city = $request->city;
        $district = $request->district;
        
        // dd($request->all());
        if($city == Auth::user()->city ){
            $getCity = city::all()->where('name_city',$city);
        }else{
            $getCity = city::all()->where('id',$city);
        }
        foreach($getCity as $itmCity){
            $data = User::find($request->id);
            $data->email = $email;
            $data->name = $name;
            $data->sex_user = $sex;
            $data->date_user = $date;
            $data->city = $itmCity->name_city;
            $data->province = $itmCity->city_province;
            $data->district = $district;
            $data->phone = $phone;

            if($request->hasFile('images')){
                $destination = 'dashboard/upload_img/user/'.Auth::user()->image;
                if(File::exists($destination))
                {
                    File::delete($destination);
                }
                $file = $request -> file('images');
                $name_file = $file -> getClientOriginalName();
                $filename = 'IMG_CLUS_'.$request->id.'_'.$name_file;
                $file -> move('dashboard/upload_img/user/',$filename);
                $data -> image = $filename;
            }
            // if($request->hasFile('image')){
            //     $file = $request -> file('image');
            //     $extension = $file ->getClientOriginalExtension();
            //     $filename = 'IMG_USER_'.Auth::user()->user_id.'_'.time().'.'.$extension;
                
            //     Storage::putFileAs('public/upload/user', $file, $filename);
            //     $data -> image = $filename;
            // }

            $data->save();
        }
        session()->flash('success', 'Cập nhật thành công');
        return back();
     }

     public function lookup_user(){
        User::where('id',Auth::user()->id)->update([
            'name_status'=>0
        ]);
        session()->flash('success','Tài khoản của bạn đã bị khóa');
        return redirect(route('logout'));
     }
}
