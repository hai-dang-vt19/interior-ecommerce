<?php

namespace App\Http\Controllers;

use App\Models\slide;
use Illuminate\Http\Request;

class slideController extends Controller
{
    public function add_slide(Request $request)
    {
        $get = slide::where('id_product',$request->id_product)->get();
        
        if($get == '[]'){
            $slide = new slide();
            $slide->id_product = $request->id_product;
            $slide->name_product = $request->name_product;
            $slide->type_product = $request->type_product;
            $slide->price = $request->price;
            $slide->images = $request->images;
            $slide->position = $request->position;
            $slide->descriptions = $request->descriptions;
            $slide->save();
            
        }else{
            slide::where('position',$request->position)->delete();
            $slide = new slide();
            $slide->id_product = $request->id_product;
            $slide->name_product = $request->name_product;
            $slide->type_product = $request->type_product;
            $slide->price = $request->price;
            $slide->images = $request->images;
            $slide->position = $request->position;
            $slide->descriptions = $request->descriptions;
            $slide->save();
        }
        session()->flash('slide_sc', 'Thêm slide thành công');
        return back();
    }
}
