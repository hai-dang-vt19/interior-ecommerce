<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\typestatus;
use App\Models\status_interior;
use App\Models\roles;

class statusController extends Controller
{
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
}
