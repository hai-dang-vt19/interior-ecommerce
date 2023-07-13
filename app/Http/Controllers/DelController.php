<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DelController extends Controller
{
    public function delview(){
        $pr = product::all();
        $selects = product::all('id','id_product','price','type_product','date');
        $distincts = product::distinct()->get(['type_product']);
        $orderbys = product::where('id','>',0)->orderbydesc('price')->get();
        $selectTops = product::orderbydesc('price')->limit(5)->get();
        $maxs = $pr->max('id_product');
        $mins = $pr->min('id_product');
        $counts = $pr->count();
        $avgs = $pr->avg('id');
        $sums = $pr->sum('id');
        $whereIns = $pr->whereIn('type_product',['Sofa','Decor']);
        $betweens = $pr->whereBetween('id',[5,9]);

        $joins = DB::table('bill')
                    ->join('product','bill.id_product','=','product.id_product')
                    ->select('bill.*','product.material','product.supplier')
                    ->take(5)
                    ->get();
        $joinWhereOns = DB::table('bill')
                        ->join('product', function ($joinW){
                            $joinW->on('bill.id_product','=','product.id_product')
                                ->where('product.amount','>',0);
                        })
                        ->orderByDesc('bill.id')
                        ->take(5)
                        ->get();
        return view('delview', compact(
            'selects','distincts','orderbys','selectTops','maxs','mins','counts',
            'avgs','sums','whereIns','betweens','joins','joinWhereOns'
            )
        );
    }
}
