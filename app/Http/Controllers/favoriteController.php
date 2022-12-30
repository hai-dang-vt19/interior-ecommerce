<?php

namespace App\Http\Controllers;

use App\Models\favorite;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class favoriteController extends Controller
{
    public function create_favorite(Request $request)
    {
        $product = product::all()->where('id_product',$request->id);
        foreach($product as $pr){
            favorite::updateOrCreate([
                'id_user'=>Auth::user()->user_id,
                'id_product'=>$request->id
            ],[
                'id_user'=>Auth::user()->user_id,
                'id_product'=>$request->id,
                'name_product'=>$pr->name_product,
                'price'=>$pr->price,
                'img'=>$pr->images,
                'status_product'=>$pr->status
            ]);
        }
        session()->flash('create_fv', '');
        return redirect()->route('product');
    }
    public function destroy_favorite_user(Request $request)
    {
        favorite::where('id_product',$request->id)->delete();
        return redirect()->route('favorite_user');
    }
}
