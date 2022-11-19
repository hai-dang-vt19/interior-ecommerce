<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\typestatus;
use App\Models\status;

class statusController extends Controller
{
    public function add_type_status(Request $request)
    {
        typestatus::updateOrCreate(['nametype'=>$request->nametype]);
        session()->flash('type_sc', $request->nametype);
        return back();
    }
    public function add_status(Request $request)
    {
        status::updateOrCreate(['name_status'=>$request->name_status, 'type_status'=>$request->type_status]);
        session()->flash('status_sc', $request->name_status);   
        return back();
    }
}
