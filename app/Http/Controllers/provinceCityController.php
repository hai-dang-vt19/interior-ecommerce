<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\province;
use App\Models\city;
use App\Models\history;
use Illuminate\Support\Facades\Auth;

class provinceCityController extends Controller
{
    public function add_province(Request $request)
    {
        province::updateOrCreate([
            'name_province'=>'Tỉnh '.$request->name_province,
        ]);
        history::create([
            'name_his'=>'Create',
            'user_his'=>Auth::user()->email.'-'.Auth::user()->roles,
            'description_his'=>'tạo tỉnh :'.$request->name_province
        ]);
        session()->flash('province_sc', 'Tỉnh '.$request->name_province);
        return back();
    }
    public function update_province(Request $request)
    {
        $pro = province::find($request->id);
        $pro->name_province =$request->name_province;
        $pro->save();
        history::create([
            'name_his'=>'Update',
            'user_his'=>Auth::user()->email.'-'.Auth::user()->roles,
            'description_his'=>'cập nhật tỉnh :'.$request->name_province
        ]);
        session()->flash('update_province_sc', $request->name_province);
        return redirect(route('list_province_dashboard'));
    }
    public function destroy_province(Request $request)
    {
        province::find($request->id)->delete();
        session()->flash('province_ds', 'Xóa thành công');
        history::create([
            'name_his'=>'Destroy',
            'user_his'=>Auth::user()->email.'-'.Auth::user()->roles,
            'description_his'=>'xóa tỉnh :'.$request->name_province
        ]);
        return back();
    }

    public function add_city(Request $request)
    {
        city::updateOrCreate([
            'name_city'=>'Tp.'.$request->name_city,
            'city_province'=>$request->city_province,
            'price'=>$request->price
        ]);
        history::create([
            'name_his'=>'Create',
            'user_his'=>Auth::user()->email.'-'.Auth::user()->roles,
            'description_his'=>'tạo thành phố :'.$request->name_city
        ]);
        session()->flash('city_sc', 'Tp.'.$request->name_city);
        return back();
    }
    public function update_city(Request $request)
    {
        $cty = city::find($request->id);
        $cty->name_city = $request->name_city;
        $cty->city_province = $request->city_province;
        $cty->price = $request->price;
        $cty->save();
        history::create([
            'name_his'=>'Update',
            'user_his'=>Auth::user()->email.'-'.Auth::user()->roles,
            'description_his'=>'cập nhật thành phố :'.$request->name_city
        ]);
        session()->flash('update_city_sc', $request->name_city);
        return redirect(route('list_province_dashboard'));
    }
    public function destroy_city(Request $request)
    {
        city::find($request->id)->delete();
        history::create([
            'name_his'=>'Destroy',
            'user_his'=>Auth::user()->email.'-'.Auth::user()->roles,
            'description_his'=>'xóa thành phố : id-'.$request->id
        ]);
        session()->flash('city_ds', 'Xóa thành công');
        return back();
    }
}
