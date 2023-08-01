<?php

namespace App\Http\Controllers;

use App\Models\Hosts;
use Illuminate\Http\Request;

class hostController extends Controller
{
    public function host_index(){
        $hosts = Hosts::limit(20)->paginate(20);
        return view('dashboards.clients.z-host', compact('hosts'));
    }
    public function host_create(Request $request){
        Hosts::updateOrCreate([
            'host'=>$request->host
        ]);
        session()->flash('success','Tạo thành công');
        return back();
    }
    public function host_active(Request $request){
        Hosts::where('active','y')->update([
            'active'=>'n'
        ]);
        Hosts::where('id',$request->id)->update([
            'active'=>'y'
        ]);
        session()->flash('success','Active thành công');
        return back();
    }
    public function host_destroy(Request $request){
        Hosts::find($request->id)->delete();
        session()->flash('success','Xóa thành công');
        return back();
    }
}
