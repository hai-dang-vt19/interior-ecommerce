<?php

namespace App\Http\Controllers;

use App\Models\slide;
use Illuminate\Http\Request;

class slideController extends Controller
{
    public function add_slide(Request $request)
    {
        slide::updateOrCreate([
            'position'=>$request->position
        ],[
            'id_product'=>$request->id_product,
            'name_product'=>$request->name_product,
            'type_product'=>$request->type_product,
            'price'=>$request->price,
            'images'=>$request->images,
            'position'=>$request->position,
            'descriptions'=>$request->descriptions,
        ]);
        // $get = slide::where('position',$request->position)->get();
        //     foreach($get as $sld){
                
        //         if($get->id == '[]'){
        //             $slide = new slide();
        //             $slide->id_product = $request->id_product;
        //             $slide->name_product = $request->name_product;
        //             $slide->type_product = $request->type_product;
        //             $slide->price = $request->price;
        //             $slide->images = $request->images;
        //             $slide->position = $request->position;
        //             $slide->descriptions = $request->descriptions;
        //             $slide->save();
        //         }else{
        //             $slide = slide::find($sld->id);
        //             $slide->id_product = $request->id_product;
        //             $slide->name_product = $request->name_product;
        //             $slide->type_product = $request->type_product;
        //             $slide->price = $request->price;
        //             $slide->images = $request->images;
        //             $slide->position = $request->position;
        //             $slide->descriptions = $request->descriptions;
        //             $slide->save();
        //         }
        //         echo $sld->
        //     }
        session()->flash('slide_sc', 'Thêm slide thành công');
        return redirect(route('slide'));
    }
}
