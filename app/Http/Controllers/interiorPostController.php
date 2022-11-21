<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\typestatus;
use App\Models\status_interior;
use App\Models\roles;
use App\Models\discount;
use App\Models\province;
use App\Models\city;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class interiorPostController extends Controller
{
     //------------------------------------------ dash board -----------------------------------------
     public function add_status(Request $request)
    {
        status_interior::updateOrCreate(['name_status'=>$request->name_status, 'type_status'=>$request->type_status]);
        session()->flash('status_sc', $request->name_status);   
        return back();
    }
    public function update_status(Request $request)
    {
        $up = status_interior::find($request->id);
        $up->name_status = $request->name_status;
        $up->type_status = $request->type_status;
        $up->save();
        session()->flash('update_status_sc', $request->name_status);
        return redirect(route('status_dashboard'));
    }
    public function destroy_status(Request $request)
    {
        status_interior::find($request->id)->delete();
        session()->flash('status_ds', 'Xóa thành công');
        return back();
    }

    public function add_type_status(Request $request)
    {
        typestatus::updateOrCreate(['nametype'=>$request->nametype]);
        session()->flash('type_sc', $request->nametype);
        return back();
    }
    public function update_type_status(Request $request)
    {
        $up = typestatus::find($request->id);
        $up->nametype = $request->nametype;
        $up->save();
        session()->flash('update_type_status', $request->nametype);
        return redirect(route('type_status_dashboard'));
    }
    public function destroy_type_status(Request $request)
    {
        typestatus::find($request->id)->delete();
        session()->flash('type_ds', 'Xóa thành công');
        return back();
    }

    public function add_roles(Request $request)
    {
        roles::updateOrCreate(['name_roles'=>$request->name_roles]);
        session()->flash('roles_sc', $request->name_roles);
        return back();
    }
    public function update_roles(Request $request)
    {
        $role = roles::find($request->id);
        $role->name_roles = $request->name_roles;
        $role->save();
        session()->flash('update_roles_sc', $request->name_roles);
        return redirect(route('roles_dashboard'));
    }
    public function destroy_roles(Request $request)
    {
        roles::find($request->id)->delete();
        session()->flash('roles_ds', 'Xóa thành công');
        return back();
    }
    
    public function add_discount(Request $request)
    {
         discount::updateOrCreate([
            'name_discount'=>$request->name_discount,
            'price'=>$request->price,
            'status_discount'=>$request->status_discount
        ]);
        session()->flash('discount_sc', $request->name_discount);
        return back();
    }
    public function update_discount(Request $request)
    {
        $updisc = discount::find($request->id);
        $updisc->name_discount = $request->name_discount;
        $updisc->price = $request->price;
        $updisc->status_discount = $request->status_discount;
        $updisc->save();
        session()->flash('update_discount_sc', $request->name_discount);
        return redirect(route('discount_dashboard'));
    }
    public function destroy_discount(Request $request)
    {
        discount::find($request->id)->delete();
        session()->flash('discount_ds', 'Xóa thành công');
        return back();
    }

    public function add_province(Request $request)
    {
        province::updateOrCreate([
            'name_province'=>$request->name_province,
        ]);
        session()->flash('province_sc', $request->name_province);
        return back();
    }
    public function update_province(Request $request)
    {
        $pro = province::find($request->id);
        $pro->name_province =$request->name_province;
        $pro->save();
        session()->flash('update_province_sc', $request->name_province);
        return redirect(route('list_province_dashboard'));
    }
    public function destroy_province(Request $request)
    {
        province::find($request->id)->delete();
        session()->flash('province_ds', 'Xóa thành công');
        return back();
    }

    public function add_city(Request $request)
    {
        city::updateOrCreate([
            'name_city'=>$request->name_city,
            'city_province'=>$request->city_province,
            'price'=>$request->price
        ]);
        session()->flash('city_sc', $request->name_city);
        return back();
    }
    public function update_city(Request $request)
    {
        $cty = city::find($request->id);
        $cty->name_city = $request->name_city;
        $cty->city_province = $request->city_province;
        $cty->price = $request->price;
        $cty->save();
        session()->flash('update_city_sc', $request->name_city);
        return redirect(route('list_province_dashboard'));
    }
    public function destroy_city(Request $request)
    {
        city::find($request->id)->delete();
        session()->flash('cit_ds', 'Xóa thành công');
        return back();
    }
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
        $user_id = $request->user_id;

        $data = User::where('email',$email)->get('email');
        $e = '[{"email":"'.$email.'"}]';
        if($data != $e){
            $user = new User();
            $user->email = $email;
            $user->password = Hash::make($password);
            $user->name = $name;
            $user->user_id = 'IT'.$user_id.time().'-KH'.rand(1,10000);
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
