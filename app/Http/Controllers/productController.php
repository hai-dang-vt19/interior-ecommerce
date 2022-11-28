<?php

namespace App\Http\Controllers;

use App\Models\history;
use App\Models\product;
use App\Models\warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;


class productController extends Controller
{
    public function add_product(Request $request)
    {
        $name_product = $request->name_product;
        $type_product = $request->type_product;
        $amount = $request->amount;
        $pri = $request->price;
        
        $pro = new product();
        $pro->id_product = 'ICS';
        $pro->name_product = $name_product;
        $pro->type_product = $type_product;
        $pro->material = $request->material;
        $pro->supplier = $request->supplier;
        $pro->color = $request->color;
        $pro->price = $request->price;
        $pro->amount = $amount;
        $pro->descriptions = $request->descriptions;
        $pro->date = $request->date;
        $pro->save();

        $update = product::where('id_product','ICS')->where('name_product',$name_product)->get();
        foreach($update as $up){
            $upro = product::find($up->id);
            $upro->id_product = 'ICS00'.$up->id;
            if($request->hasFile('images')){
                $file = $request -> file('images');
                $name_file = $file -> getClientOriginalName();
                $filename = 'Images_1_ICS00'.$up->id.'_'.$name_file;
                $file -> move('dashboard/upload_img/product/',$filename);
                $upro->images = $filename;
            }
            if($request->hasFile('images2')){
                $file2 = $request -> file('images2');
                $name_file2 = $file2 -> getClientOriginalName();
                $filename2 = 'Images_2_ICS00'.$up->id.'_'.$name_file2;
                $file2 -> move('dashboard/upload_img/product/',$filename2);
                $upro->images2 = $filename2;
            }
            $upro->save();
        }
        $get_warehouse = warehouse::where('name_product',$name_product)->where('name',$type_product)->get();
        foreach($get_warehouse as $get_ware){
            $sum = $amount + $get_ware->amount;
            $get_ware->update(['amount'=>$sum]);
        }
        history::create([
            'name_his'=>'Create',
            'user_his'=>Auth::user()->email.'-'.Auth::user()->roles,
            'description_his'=>'Tạo sản phẩm :'.$name_product
        ]);
        session()->flash('product_sc', 'ICS00'.$up->id);
        return back();
    }

    public function udpate_product(Request $request)
    {
        $name_product = $request->name_product;
        $type_product = $request->type_product;
        $amount = $request->amount;

        $get = product::where('id',$request->id)->get();
        foreach($get as $pro){
            if($pro->images != null){
                File::delete('dashboard/upload_img/product/'.$pro->images);
            }
            if($pro->images2 != null){
                File::delete('dashboard/upload_img/product/'.$pro->images2);
            }
        }
        $product = product::find($request->id);
            $product->name_product = $name_product;
            $product->type_product = $type_product;
            $product->material = $request->material;
            $product->supplier = $request->supplier;
            if($request->hasFile('images')){
                $file = $request -> file('images');
                $name_file = $file -> getClientOriginalName();
                $filename = 'Images_1_ICS00'.$request->id.'_'.$name_file;
                $file -> move('dashboard/upload_img/product/',$filename);
                $product->images = $filename;
            }
            if($request->hasFile('images2')){
                $file2 = $request -> file('images2');
                $name_file2 = $file2 -> getClientOriginalName();
                $filename2 = 'Images_2_ICS00'.$request->id.'_'.$name_file2;
                $file2 -> move('dashboard/upload_img/product/',$filename2);
                $product->images2 = $filename2;
            }
            $product->color = $request->color;
            $product->price = $request->price;
            $product->amount = $amount;
            $product->descriptions = $request->descriptions;
            $product->date = $request->date;
        $product->save();

        $get_warehouse = warehouse::where('name_product',$name_product)->where('name',$type_product)->update(['amount'=>$amount]);
        // foreach($get_warehouse as $get_ware){
        //     $sum = $amount + $get_ware->amount;
        //     $get_ware->update(['amount'=>$sum]);
        // }
        history::create([
            'name_his'=>'Update',
            'user_his'=>Auth::user()->email.'-'.Auth::user()->roles,
            'description_his'=>'Cập nhật sản phẩm :'.$name_product
        ]);
        session()->flash('product_update_sc', 'Cập nhật sản phẩm thành công');
        return redirect(route('list_product_dashboard'));
    }

    public function destroy_product(Request $request)
    {
        $product = product::where('id',$request->id)->get();
        foreach($product as $pro){
            $pro->delete();
            if($pro->images != null){
                File::delete('dashboard/upload_img/product/'.$pro->images);
            }
            if($pro->images2 != null){
                File::delete('dashboard/upload_img/product/'.$pro->images2);
            }
            warehouse::where('name_product',$pro->name_product)
                    ->where('name',$pro->type_product)
                    ->update(['amount'=>'0']);
            history::create([
            'name_his'=>'Destroy',
            'user_his'=>Auth::user()->email.'-'.Auth::user()->roles,
            'description_his'=>'Cập nhật sản phẩm :'.$pro->id_product
        ]);
        }
        
        session()->flash('product_ds', 'Xóa sản phẩm thành công');
        return back();
    }
}
