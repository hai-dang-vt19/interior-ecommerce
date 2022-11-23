<?php

namespace App\Http\Controllers;

use App\Models\color;
use App\Models\history;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class colorController extends Controller
{
    public function add_color(Request $request)
    {
        color::updateOrCreate([
            'color'=>$request->color,
        ]);
        history::create([
            'name_his'=>'Create',
            'user_his'=>Auth::user()->email.'-'.Auth::user()->roles,
            'description_his'=>Auth::user()->email.': tạo màu :'.$request->color
        ]);
        session()->flash('color_sc', $request->color);
        return back();
    }
    public function update_color(Request $request)
    {
        $color = color::find($request->id);
        $color->color = $request->color;
        $color->save();
        history::create([
            'name_his'=>'Update',
            'user_his'=>Auth::user()->email.'-'.Auth::user()->roles,
            'description_his'=>Auth::user()->email.': cập nhật màu :'.$request->color
        ]);
        session()->flash('update_color_sc', $request->color);
        return redirect(route('color_dashboard'));
    }
    public function destroy_color(Request $request)
    {
        color::find($request->id)->delete();
        history::create([
            'name_his'=>'Destroy',
            'user_his'=>Auth::user()->email.'-'.Auth::user()->roles,
            'description_his'=>Auth::user()->email.': xóa màu :'.$request->color
        ]);
        session()->flash('color_ds', 'Xóa thành công');
        return back();
    }
}
