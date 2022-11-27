<?php

namespace App\Http\Controllers;

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

        session()->flash('product_sc', 'ICS00'.$up->id);
        return back();
    }
}
