<?php

namespace App\Http\Controllers;

use App\Models\history;
use App\Models\warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class warehouseController extends Controller
{
    public function add_warehouse(Request $request)
    {
        warehouse::create([
            'name'=>$request->name,
            'name_product'=>$request->name_product,
            'material'=>$request->material,
            'supplier'=>$request->supplier
        ]);
        history::create([
            'name_his'=>'Create',
            'user_his'=>Auth::user()->email.'-'.Auth::user()->name_roles,
            'description_his'=>'Tạo kho :'.$request->name
        ]);

        session()->flash('warehouse_sc', $request->name);
        return redirect(route('warehouse_dashboard'));
    }
    public function update_warehouse(Request $request)
    {
        $up = warehouse::find($request->id);
        $up->name = $request->name;
        $up->name_product = $request->name_product;
        $up->material = $request->material;
        $up->supplier = $request->supplier;
        $up->save();
        history::create([
            'name_his'=>'Update',
            'user_his'=>Auth::user()->email.'-'.Auth::user()->name_roles,
            'description_his'=>'Cập nhật kho :'.$request->name
        ]);
        session()->flash('warehouse_update_sc',$request->name);
        return redirect(route('list_warehouse_dashboard'));
    }

    public function destroy_warehouse(Request $request)
    {
        warehouse::find($request->id)->delete();
        history::create([
            'name_his'=>'Destroy',
            'user_his'=>Auth::user()->email.'-'.Auth::user()->name_roles,
            'description_his'=>'Xóa kho'
        ]);
        session()->flash('warehouse_ds', 'Xóa thành công');
        return redirect(route('warehouse_dashboard'));
    }
}
