<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
    public function destroy_user(Request $request)
    {
        User::find($request->id)->delete();
        session()->flash('user_ds', 'Xóa thành công');
        return back();
    }
}
