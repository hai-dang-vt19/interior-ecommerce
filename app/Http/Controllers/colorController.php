<?php

namespace App\Http\Controllers;

use App\Models\color;
use Illuminate\Http\Request;

class colorController extends Controller
{
    public function add_color(Request $request)
    {
        color::updateOrCreate([
            'color'=>$request->color,
        ]);
        session()->flash('color_sc', $request->color);
        return back();
    }
    public function update_color(Request $request)
    {
        $color = color::find($request->id);
        $color->color = $request->color;
        $color->save();
        session()->flash('update_color_sc', $request->color);
        return redirect(route('color_dashboard'));
    }
    public function destroy_color(Request $request)
    {
        color::find($request->id)->delete();
        session()->flash('color_ds', 'Xóa thành công');
        return back();
    }
}
