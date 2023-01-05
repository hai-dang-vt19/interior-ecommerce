<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\product;
use App\Models\warehouse;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class cartController extends Controller
{
    public function add_cart(Request $request)
    {
        $carbon = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
        $get_product = product::where('id',$request->id)->get();
        foreach($get_product as $get){
            $amount = $get->amount-$request->quantity; //Update bảng product
            $total = $request->quantity * $get->price;
            $color = $get->color.', '.$get->color2.', '.$get->color3;

            $check_cart = cart::all()->where('id_cart_user','CART_CS'.Auth::user()->user_id)->where('id_product',$get->id_product);
            if($check_cart == '[]'){
                cart::updateOrCreate([
                'id_cart_user'=>'CART_CS'.Auth::user()->user_id,
                'id_product'=>$get->id_product
                ],[
                    'id_cart_user'=>'CART_CS'.Auth::user()->user_id,
                    'id_product'=>$get->id_product,
                    'name_product'=> $get->name_product,
                    'type_product'=> $get->type_product,
                    'color_product'=> $color,
                    'amount_product'=> $request->quantity,
                    'status_product'=> $get->status,
                    'price_product'=> $get->price,
                    'image_product'=> $get->images,
                    'datecreate'=> $carbon,
                    'total'=>$total,
                    'sales'=>$get->sales,
                    'total_sales'=>$get->sales*$request->quantity
                ]);
            }else{
                foreach($check_cart as $ck_cart){
                    $amt_old = $ck_cart->amount_product;
                    $amt_new = $amt_old+$request->quantity;
                    $price_new = $get->price*$amt_new;
                    
                    cart::updateOrCreate([
                        'id_cart_user'=>'CART_CS'.Auth::user()->user_id,
                        'id_product'=>$get->id_product
                        ],[
                            'id_cart_user'=>'CART_CS'.Auth::user()->user_id,
                            'id_product'=>$get->id_product,
                            'name_product'=> $get->name_product,
                            'type_product'=> $get->type_product,
                            'color_product'=> $color,
                            'amount_product'=> $amt_new,
                            'status_product'=> $get->status,
                            'price_product'=> $get->price,
                            'image_product'=> $get->images,
                            'datecreate'=> $carbon,
                            'total'=>$price_new,
                            'sales'=>$get->sales,
                            'total_sales'=>$get->sales*$amt_new
                        ]);
                    
                }
            }
            // warehouse::where('name_product',$get->name_product)->where('material',$get->material)->update(['amount'=>$amount]); khi nào tahnh toán mới trừ số lượng vào kho
            product::where('id',$request->id)->update(['amount'=>$amount]);
            
        }
        session()->flash('cart_sc', 'Thêm vào giỏ hàng thành công');
        return back();
    }
    
    public function destroy_cart_product(Request $request)
    {
        $getPr = product::where('id_product',$request->id_pr)->get();
        foreach($getPr as $pr){
            $g_amo = $pr->amount;
            $sum = $g_amo+$request->amount_pr;
            $pr->update(['amount'=>$sum]);
        }
        cart::find($request->id)->delete();
        return back();
    }
}