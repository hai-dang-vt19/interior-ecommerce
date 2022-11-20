<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\typestatus;
use App\Models\status_interior;
use App\Models\roles;
use Illuminate\Support\Facades\Auth;

class interiorController extends Controller
{
    //------------------------------------------ dash board -----------------------------------------
    public function login()
    {
        return view('dashboards.login');
    }
    public function register()
    {
        return view('dashboards.register');
    }

    public function index_dashboard()
    {
        // if(Auth::user())
        return view('dashboards.index-dashboard');
    }

    public function product_dashboard()
    {
        return view('dashboards.clients.new-product');
    }
    public function list_product_dashboard()
    {
        return view('dashboards.clients.list-product');
    }

    public function type_dashboard()
    {
        return view('dashboards.clients.new-type');
    }
    public function list_type_dashboard()
    {
        return view('dashboards.clients.list-type');
    }

    public function supplier_dashboard()
    {
        return view('dashboards.clients.new-supplier');
    }
    public function list_supplier_dashboard()
    {
        return view('dashboards.clients.list-supplier');
    }

    public function material_dashboard()
    {
        return view('dashboards.clients.new-material');
    }
    public function list_material_dashboard()
    {
        return view('dashboards.clients.list-material');
    }

    public function warehouse_dashboard()
    {
        return view('dashboards.clients.new-warehouse');
    }
    public function list_warehouse_dashboard()
    {
        return view('dashboards.clients.list-warehouse');
    }

    public function user_dashboard()
    {
        return view('dashboards.clients.new-user');
    }
    public function list_user_dashboard()
    {
        return view('dashboards.clients.list-user');
    }

    public function favorite_dashboard()
    {
        return view('dashboards.clients.new-favorite');
    }
    public function list_favorite_dashboard()
    {
        return view('dashboards.clients.list-favorite');
    }

    public function cart_dashboard()
    {
        return view('dashboards.clients.new-cart');
    }
    public function list_cart_dashboard()
    {
        return view('dashboards.clients.list-cart');
    }

    public function comment_dashboard()
    {
        return view('dashboards.clients.z-comment');
    }

    public function roles_dashboard()
    {
        $roles = roles::all();
        return view('dashboards.clients.z-roles', compact('roles'));
    }
    public function edit_roles_dashboard(Request $request)
    {
        $data['rol'] = roles::find($request->id)->toArray();
        return view('dashboards.updates.z-roles-update', $data);
    }

    public function status_dashboard()
    {
        $type = typestatus::all();
        $status = status_interior::limit(5)->paginate(5);
        return view('dashboards.clients.z-status', compact('status','type'));
    }
    public function edit_status_dashboard(Request $request)
    {
        $type = typestatus::all();
        $data['stt'] = status_interior::find($request->id)->toArray();
        return view('dashboards.updates.z-status-update',$data,compact('type'));
    }
    public function type_status_dashboard()
    {
        $type = typestatus::limit(5)->paginate(5);
        return view('dashboards.clients.z-status-type', compact('type'));
    }
    public function edit_type_status_dashboard(Request $request)
    {
        $data['type_status'] = typestatus::find($request->id);
        return view('dashboards.updates.z-status-type-update',$data);
    }
    
    public function discount_dashboard()
    {
        return view('dashboards.clients.z-discount');
    }

    public function list_province_dashboard()
    {
        return view('dashboards.clients.list-province');
    }

    public function list_city_dashboard()
    {
        return view('dashboards.clients.list-city');
    }

    public function color_dashboard()
    {
        return view('dashboards.clients.z-color');
    }
    //------------------------------------------   client   -----------------------------------------
    public function blog()
    {
        return view('interiors.blog');
    }
    public function index()
    {
        return view('interiors.index');
    }
    public function product()
    {
        return view('interiors.product');
    }
}
