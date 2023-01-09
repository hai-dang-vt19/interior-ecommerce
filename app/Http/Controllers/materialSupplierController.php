<?php

namespace App\Http\Controllers;

use App\Models\supplier;
use App\Models\material;
use App\Models\status_interior;
use App\Models\history;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class materialSupplierController extends Controller
{
    public function add_supplier(Request $request)
    {
        supplier::updateOrCreate([
            'name_supplier'=>$request->name_supplier,
            'status_supplier'=>$request->status_supplier
        ]);
        history::create([
            'name_his'=>'Create',
             'user_his'=>Auth::user()->email,
            'description_his'=>'Tạo nhà cung cấp :'.$request->name_supplier
        ]);
        session()->flash('supplier_sc', $request->name_supplier);
        return back();
    }
    public function update_supplier(Request $request)
    {
        $sup = supplier::find($request->id);
        $sup->name_supplier = $request->name_supplier;
        $sup->status_supplier = $request->status_supplier;
        $sup->save();

        history::create([
            'name_his'=>'Update',
             'user_his'=>Auth::user()->email,
            'description_his'=>'Cập nhật nhà cung cấp :'.$request->name_supplier
        ]);

        session()->flash('supplier_update_sc', $request->name_supplier);
        return redirect(route('supplier_dashboard'));
    }
    public function destroy_supplier(Request $request)
    {
        supplier::find($request->id)->delete();
        history::create([
            'name_his'=>'Destroy',
             'user_his'=>Auth::user()->email,
            'description_his'=>'Xóa nhà cung cấp :'.$request->id
        ]);
        session()->flash('supplier_ds', 'Xóa thành công');
        return back();
    }

    public function add_material(Request $request)
    {
        material::updateOrCreate([
            'name_material'=>$request->name_material,
            'price'=>$request->price,
            'supplier'=>$request->supplier,
            'status_material'=>$request->status_material
        ]);
        history::create([
            'name_his'=>'Create',
             'user_his'=>Auth::user()->email,
            'description_his'=>'Thêm chất liêu :'.$request->name_material
        ]);
        session()->flash('material_sc', $request->name_material);
        return back();
    }
    public function update_material(Request $request)
    {
        $ma = material::find($request->id);
        $ma->name_material = $request->name_material;
        $ma->price = $request->price;
        $ma->supplier = $request->supplier;
        $ma->status_material = $request->status_material;
        $ma->save();
        history::create([
            'name_his'=>'Update',
             'user_his'=>Auth::user()->email,
            'description_his'=>'Cập nhật chất liệu :'.$request->name_material
        ]);

        session()->flash('material_update_sc', $request->name_material);
        return redirect(route('material_dashboard'));
    }
    public function destroy_material(Request $request)
    {
        material::find($request->id)->delete();
        history::create([
            'name_his'=>'Destroy',
             'user_his'=>Auth::user()->email,
            'description_his'=>'Xóa chất liệu :'.$request->id
        ]);
        session()->flash('material_ds', 'Xóa thành công');
        return back();
    }
}
