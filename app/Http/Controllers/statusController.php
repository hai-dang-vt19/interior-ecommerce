<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\typestatus;
use App\Models\status_interior;
use App\Models\roles;
use App\Models\discount;
use App\Models\history;
use Illuminate\Support\Facades\Auth;

class statusController extends Controller
{
    public function add_status(Request $request)
    {
        status_interior::updateOrCreate(['name_status'=>$request->name_status, 'type_status'=>$request->type_status]);
        history::create([
            'name_his'=>'Create',
            'user_his'=>Auth::user()->email.'-'.Auth::user()->roles,
            'description_his'=>Auth::user()->email.': tạo trạng thái :'.$request->name_status
        ]);
        session()->flash('status_sc', $request->name_status);   
        return back();
    }
    public function update_status(Request $request)
    {
        $up = status_interior::find($request->id);
        $up->name_status = $request->name_status;
        $up->type_status = $request->type_status;
        $up->save();
        history::create([
            'name_his'=>'Update',
            'user_his'=>Auth::user()->email.'-'.Auth::user()->roles,
            'description_his'=>Auth::user()->email.': cập nhật trạng thái :'.$request->name_status
        ]);
        session()->flash('update_status_sc', $request->name_status);
        return redirect(route('status_dashboard'));
    }
    public function destroy_status(Request $request)
    {
        status_interior::find($request->id)->delete();
        history::create([
            'name_his'=>'Destroy',
            'user_his'=>Auth::user()->email.'-'.Auth::user()->roles,
            'description_his'=>Auth::user()->email.': xóa trạng thái :'.$request->name_status
        ]);
        session()->flash('status_ds', 'Xóa thành công');
        return back();
    }

    public function add_type_status(Request $request)
    {
        typestatus::updateOrCreate(['nametype'=>$request->nametype]);
        history::create([
            'name_his'=>'Create',
            'user_his'=>Auth::user()->email.'-'.Auth::user()->roles,
            'description_his'=>Auth::user()->email.': tạo loại trạng thái :'.$request->nametype
        ]);
        session()->flash('type_sc', $request->nametype);
        return back();
    }
    public function update_type_status(Request $request)
    {
        $up = typestatus::find($request->id);
        $up->nametype = $request->nametype;
        $up->save();
        history::create([
            'name_his'=>'Update',
            'user_his'=>Auth::user()->email.'-'.Auth::user()->roles,
            'description_his'=>Auth::user()->email.': cập nhật loại trạng thái :'.$request->nametype
        ]);
        session()->flash('update_type_status', $request->nametype);
        return redirect(route('type_status_dashboard'));
    }
    public function destroy_type_status(Request $request)
    {
        typestatus::find($request->id)->delete();
        history::create([
            'name_his'=>'Destroy',
            'user_his'=>Auth::user()->email.'-'.Auth::user()->roles,
            'description_his'=>Auth::user()->email.': xóa loại trạng thái :'.$request->nametype
        ]);
        session()->flash('type_ds', 'Xóa thành công');
        return back();
    }

    public function add_roles(Request $request)
    {
        roles::updateOrCreate(['name_roles'=>$request->name_roles]);
        history::create([
            'name_his'=>'Create',
            'user_his'=>Auth::user()->email.'-'.Auth::user()->roles,
            'description_his'=>Auth::user()->email.': tạo quyền :'.$request->name_roles
        ]);
        session()->flash('roles_sc', $request->name_roles);
        return back();
    }
    public function update_roles(Request $request)
    {
        $role = roles::find($request->id);
        $role->name_roles = $request->name_roles;
        $role->save();
        history::create([
            'name_his'=>'Update',
            'user_his'=>Auth::user()->email.'-'.Auth::user()->roles,
            'description_his'=>Auth::user()->email.': cập nhật quyền :'.$request->name_roles
        ]);
        session()->flash('update_roles_sc', $request->name_roles);
        return redirect(route('roles_dashboard'));
    }
    public function destroy_roles(Request $request)
    {
        roles::find($request->id)->delete();
        history::create([
            'name_his'=>'Destroy',
            'user_his'=>Auth::user()->email.'-'.Auth::user()->roles,
            'description_his'=>Auth::user()->email.': xóa quyền :'.$request->name_roles
        ]);
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
        history::create([
            'name_his'=>'Create',
            'user_his'=>Auth::user()->email.'-'.Auth::user()->roles,
            'description_his'=>Auth::user()->email.': tạo mã giảm giá :'.$request->name_discount
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
        history::create([
            'name_his'=>'Update',
            'user_his'=>Auth::user()->email.'-'.Auth::user()->roles,
            'description_his'=>Auth::user()->email.': cập nhật mã giảm giá :'.$request->name_discount
        ]);
        session()->flash('update_discount_sc', $request->name_discount);
        return redirect(route('discount_dashboard'));
    }
    public function destroy_discount(Request $request)
    {
        discount::find($request->id)->delete();
        history::create([
            'name_his'=>'Destroy',
            'user_his'=>Auth::user()->email.'-'.Auth::user()->roles,
            'description_his'=>Auth::user()->email.': xóa mã giảm giá :'.$request->name_discount
        ]);
        session()->flash('discount_ds', 'Xóa thành công');
        return back();
    }
}
