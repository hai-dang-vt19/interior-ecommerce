<?php

namespace App\Http\Controllers;

use App\Mail\OrderShipped;
use App\Models\city;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\history;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class interiorPostController extends Controller
{
     //------------------------------------------ dash board -----------------------------------------
     //------------------------------------------ login -----------------------------------------
     public function login_interior(Request $request)
     {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::check()) {
                if(Auth::user()->name_roles == 'user'){
                    session()->flash('login-sc', 'Đăng nhập thành công')    ;
                    return redirect(route('index'));
                }elseif(Auth::user()->name_roles == 'admin'){
                    session()->flash('login-sc', 'Đăng nhập thành công');
                    return redirect(route('index_dashboard'));
                }else{
                    session()->flash('login-sc', 'Đăng nhập thành công');
                    return redirect(route('bill_dashboad'));
                }
            } else {
                return false;
            }  
        }else{
            session()->flash('login-er', 'Tài khoản hoặc mật khẩu không chính xác');
            return redirect(route('login'));
        }
     }
     public function register_interior(Request $request)
     {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6',
            'check_password' =>  'required|same:password',
        ], [
            'name.required' => '* Bạn chưa nhập tên tài khoản',
            'email.required' => '* Bạn chưa nhập email',
            'password.required' => '* Bạn chưa nhập mật khẩu',
            'password.min' => '* Mật khẩu tối thiểu 6 ký tự',
            'check_password.required' => '* Bạn chưa nhập mật khẩu',
            'check_password.same' => '* Nhập lại mật khẩu không chính xác',
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
                session()->flash('register-er', 'Đăng ký không thành công');
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
        \App\Jobs\DemoEmail::dispatch($data, $request->email)->delay(now()->addSeconds(2));
        session()->flash('msg', 'Gửi mail thành công');
        return redirect(route('contact'));
     }
     
     public function update_profile_city_cart(Request $request)
     {
        User::where('id',$request->id)->update([
            'district'=>$request->district,
            'city'=>$request->city,
            'province'=>$request->province
        ]);
        session()->flash('update_sc', 'Cập nhật thành công');
        return redirect()->route('cart');
     }
     public function update_profile_city(Request $request)
     {
        $provinces = city::all()->where('name_city',$request->city);
        foreach($provinces as $pro){
            User::where('id',$request->id)->update([
                'email'=>$request->email,
                'name'=>$request->name,
                'sex_user'=>$request->sex_user,
                'date_user'=>$request->date_user,
                'phone'=>$request->phone,
                'city'=>$request->city,
                'district'=>$request->district,
                'province'=>$pro->city_province
            ]);
        }
        session()->flash('update_sc', 'Cập nhật thành công');
        return redirect()->route('profile_user');
     }
     public function update_password(Request $request)
     {
        $request->validate([
            'pass_old' => 'required',
            'pass_new' => 'required|min:6',
            'check_pass_new' =>  'required|same:pass_new',
        ], [
            'pass_old.required' => '* Chưa nhập mật khẩu cũ',
            'pass_new.required' => '* Chưa nhập mật khẩu',
            'pass_new.min' => '* Mật khẩu tối thiểu 6 ký tự',
            'check_pass_new.required' => '* Chưa nhập mật khẩu',
            'check_pass_new.same' => '* Nhập lại mật khẩu không chính xác',
        ]);
        
        $pass_old = $request->pass_old;
        $pass_new = $request->pass_new;
        $get_info = User::where('email',Auth::user()->email);
        $old_pass = Auth::user()->password;
        if(Hash::check($pass_old, $old_pass)){
            $get_info->update(['password'=>Hash::make($pass_new)]);
            session()->flash('tb_sc', 'Đổi mật khẩu thành công');
        }else{
            session()->flash('tb_er', 'Mật khẩu cũ không chính xác');
        }
        return back();
     }
}
