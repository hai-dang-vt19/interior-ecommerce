<?php

namespace App\Http\Controllers;

use App\Models\typeproduct;
use App\Models\status_interior;
use App\Models\history;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class typeController extends Controller
{
    public function add_type_product(Request $request)
    {
        $name = $request->name_type;
        $status = $request->type_status;
        
        typeproduct::updateOrCreate([
            'name_type'=>$name,
            'type_status'=>$status
        ]);
        history::create([
            'name_his'=>'Create',
            'user_his'=>Auth::user()->email.'-'.Auth::user()->name_roles,
            'description_his'=>'Tạo loại sản phẩm:'.$request->name_type
        ]);
        session()->flash('type_product_sc', $name);
        return back();
    }
    public function update_type_product(Request $request)
    {
        $type = typeproduct::find($request->id);
        $type->name_type = $request->name_type;
        $type->type_status = $request->type_status;
        $type->save();
        session()->flash('type_product_update_sc', $request->name_type);
        return redirect(route('list_type_dashboard'));
    }
    public function destroy_type_product(Request $request)
    {
        typeproduct::find($request->id)->delete();
        history::create([
            'name_his'=>'Destroy',
            'user_his'=>Auth::user()->email.'-'.Auth::user()->name_roles,
            'description_his'=>'Xóa loại sản phẩm :'.$request->id
        ]);
        session()->flash('type_product_ds', 'Xóa thành công');
        return back();
    }
}
