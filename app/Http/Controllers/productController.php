<?php

namespace App\Http\Controllers;

use App\Models\comments;
use App\Models\expense;
use App\Models\history;
use App\Models\material;
use App\Models\product;
use App\Models\warehouse;
use Carbon\Carbon;
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
        
        $get_price_material = material::where('name_material',$request->material)
                                    ->where('supplier',$request->supplier)
                                    ->get();
        foreach($get_price_material as $gpm){
            $get_pm = $gpm->price;
        }
        $sum_price = $get_pm+$pri;

        $pro = new product();
        $pro->id_product = 'ICS';
        $pro->name_product = $name_product;
        $pro->type_product = $type_product;
        $pro->material = $request->material;
        $pro->supplier = $request->supplier;
        $pro->color = $request->color;
        $pro->color2 = $request->color2;
        $pro->color3 = $request->color3;
        $pro->price = $sum_price;
        $pro->sales = $sum_price*((100-$request->sales)/100);
        $pro->amount = $amount;
        $pro->descriptions = $request->descriptions;
        $pro->date = $request->date;
        $pro->size = $request->size;
        $pro->save();

        $update = product::where('id_product','ICS')->where('name_product',$name_product)->get();
        foreach($update as $up){
            $upro = product::find($up->id);
            $upro->id_product = 'ICS00'.$up->id;
            if($request->hasFile('images')){
                $file = $request -> file('images');
                $name_file = $file -> getClientOriginalName();
                $filename = 'Images_1_ICS00'.$up->id.'_'.$up->size.'_'.$name_file;
                $file -> move('dashboard/upload_img/product/',$filename);
                $upro->images = $filename;
            }
            if($request->hasFile('images2')){
                $file2 = $request -> file('images2');
                $name_file2 = $file2 -> getClientOriginalName();
                $filename2 = 'Images_2_ICS00'.$up->id.'_'.$up->size.'_'.$name_file2;
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

        // lấy giá vật liệu để thêm vào expense (giá x số lượng)
        $expense_material = $amount*$get_pm;
        $get_year = Carbon::now('Asia/Ho_Chi_Minh')->year;
        $old_expense = expense::where('years',$get_year)->get('expense_material');
        foreach($old_expense as $old_expen){
            $get_old_ex = $old_expen->expense_material;
        }
        if($get_old_ex == 0){
            $amount_material = $amount*$get_pm;
            if($get_old_ex == 0){
                expense::where('years',$get_year)->update(['expense_material'=>$amount_material]);
            }else{
                expense::create(['years'=>$get_year,'expense_material'=>$amount_material]);
            }
        }else{
            $amount_material = $amount*$get_pm+$get_old_ex;
            expense::updateOrCreate([
                'years'=>$get_year
            ],[
                'years'=>$get_year,
                'expense_material'=>$amount_material
            ]);
        }         

        history::create([
            'name_his'=>'Create',
            'user_his'=>Auth::user()->email,
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
        
        $product = product::find($request->id);
            $product->name_product = $name_product;
            $product->type_product = $type_product;
            $product->material = $request->material;
            $product->supplier = $request->supplier;
            if($request->images != null){
                foreach($get as $pro){
                    if($pro->images != null){
                        File::delete('dashboard/upload_img/product/'.$pro->images);
                    }
                }
                if($request->hasFile('images')){
                    $file = $request -> file('images');
                    $name_file = $file -> getClientOriginalName();
                    $filename = 'Images_1_ICS00'.$request->id.'_'.$request->size.'_'.$name_file;
                    $file -> move('dashboard/upload_img/product/',$filename);
                    $product->images = $filename;
                }
            }else{
                $product->images = $request->images_c;
            }
            if($request->images2 != null){
                foreach($get as $pro){
                    if($pro->images2 != null){
                        File::delete('dashboard/upload_img/product/'.$pro->images2);
                    }
                }
                if($request->hasFile('images2')){
                    $file2 = $request -> file('images2');
                    $name_file2 = $file2 -> getClientOriginalName();
                    $filename2 = 'Images_2_ICS00'.$request->id.'_'.$request->size.'_'.$name_file2;
                    $file2 -> move('dashboard/upload_img/product/',$filename2);
                    $product->images2 = $filename2;
                }
            }else{
                $product->images2 = $request->images2_c;
            }
            
            $product->color = $request->color;
            $product->color2 = $request->color2;
            $product->color3 = $request->color3;
            $product->price = $request->price;
            if ($request->sales1 != null) {
                $product->sales = $request->price*((100-$request->sales1)/100);
            } else {
                $product->sales = $request->sales2;
            }
            $product->amount = $amount;
            $product->descriptions = $request->descriptions;
            $product->date = $request->date;
            $product->size = $request->size;
        $product->save();

        $get_warehouse = warehouse::where('name_product',$name_product)->where('name',$type_product)->update(['amount'=>$amount]);
        // foreach($get_warehouse as $get_ware){
        //     $sum = $amount + $get_ware->amount;
        //     $get_ware->update(['amount'=>$sum]);
        // }

        //Lấy số lượng * giá materi + expens_materi cũ
        $get_price_material = material::where('name_material',$request->material)
                                    ->where('supplier',$request->supplier)
                                    ->get();
        foreach($get_price_material as $gpm){
            $get_pm = $gpm->price; // giá material
        }
        $get_year = Carbon::now('Asia/Ho_Chi_Minh')->year;
        if($request->check_expense == 1){
            $old_expense = expense::where('years',$get_year)->get('expense_material');
            foreach($old_expense as $old_expen){
                $get_old_ex = $old_expen->expense_material;
            }

            if($old_expense == '[]'){
                $amount_material = $amount*$get_pm;
                expense::create(['years'=>$get_year,'expense_material'=>$amount_material]);
            }else{
                $amount_material = $amount*$get_pm+$get_old_ex;
                expense::updateOrCreate([
                    'years'=>$get_year
                ],[
                    'years'=>$get_year,
                    'expense_material'=>$amount_material
                ]);
            }            
        }

        history::create([
            'name_his'=>'Update',
             'user_his'=>Auth::user()->email,
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
             'user_his'=>Auth::user()->email,
            'description_his'=>'Cập nhật sản phẩm :'.$pro->id_product
        ]);
        }
        
        session()->flash('product_ds', 'Xóa sản phẩm thành công');
        return back();
    }
    public function create_comment(Request $request)
    {
        $data = new comments();
        $data->name_user = Auth::user()->name;
        $data->id_user = Auth::user()->user_id;
        $data->id_product = $request->id_product_cmt;
        $data->descriptions = $request->des_cmt;
        $data->status_comment = "ok";
        $data->date_create = $request->date_crt_cmt;
        $data->img = $request->img;
        $data->save();
        return back();
    }
}
