<?php

namespace App\Http\Controllers;

use App\Mail\OrderShipped;
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
                }else{
                    session()->flash('login-sc', 'Đăng nhập thành công');
                    return redirect(route('index_dashboard'));
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
}
