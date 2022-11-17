<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class interiorPostController extends Controller
{
     //------------------------------------------ dash board -----------------------------------------
     public function login_interior(Request $request)
     {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::check()) {
                if(Auth::user()->name_roles == 'admin'){
                    session()->flash('login-sc', 'Đăng nhập thành công')    ;
                    return view('dashboards.index-dashboard');
                }else{
                    session()->flash('login-sc', 'Đăng nhập thành công');
                    return view('interiors.index');
                }
            } else {
                return false;
            }  
        }else{
            session()->flash('login-er', 'Tài khoản hoặc mật khẩu không chính xác');
            return redirect(route('login'));
        }
        // $credentials = $request->validate([
        //     'email' => ['required', 'email'],
        //     'password' => ['required'],
        // ]);
        // if (Auth::attempt($credentials)) {
        //     $request->session()->regenerate();
        //     if (Auth::check()) {
        //         session()->flash('login-sc', 'Đăng nhập thành công');
        //         // return redirect(route('index_dashboard'));
        //         return view('dashboards.index-dashboard');
        //     } else {
        //         return false;
        //     }  
        // }else{
        //     session()->flash('login-er', 'Tài khoản hoặc mật khẩu không chính xác');
        //     return redirect(route('login'));
        // }
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
            $user->save();
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
        Auth::logout();
        return redirect(route('login'));
     }
 
     //------------------------------------------   client   -----------------------------------------
}
