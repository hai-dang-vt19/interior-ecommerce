<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\typestatus;
use App\Models\status_interior;
use App\Models\roles;
use App\Models\discount;
use App\Models\province;
use App\Models\city;
use App\Models\color;
use App\Models\history;
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
        if(Auth::user()->name_roles == 'admin'){
            $roles = roles::where('name_roles','!=','admin')->get();
        }elseif(Auth::user()->name_roles == 'manager'){
            $roles = roles::where('name_roles','!=','admin')
                            ->where('name_roles','!=','manager')
                            ->get();
        }else{
            $roles = roles::where('name_roles','!=','admin')
                            ->where('name_roles','!=','manager')
                            ->where('name_roles','!=','staff')
                            ->get();
        }
        return view('dashboards.clients.new-user', compact('roles'));
    }
    public function list_user_dashboard()
    {
        $user = User::limit(10)->paginate(10);
        return view('dashboards.clients.list-user',compact('user'));
    }
    public function edit_list_user(Request $request)
    {
        $up_user['user'] = User::find($request->id)->toArray();
        $pro = province::all();
        $cty = city::all();
        if(Auth::user()->name_roles == 'admin'){
            $rol = roles::where('name_roles','!=','admin')->get();
        }elseif(Auth::user()->name_roles == 'manager'){
            $rol = roles::where('name_roles','!=','admin')
                            ->where('name_roles','!=','manager')
                            ->get();
        }else{
            $rol = roles::where('name_roles','!=','admin')
                            ->where('name_roles','!=','manager')
                            ->where('name_roles','!=','staff')
                            ->get();
        }
        return view('dashboards.updates.list-user-update',$up_user,compact('pro','cty','rol'));
    }
    public function edit_profile_user()
    {
        $cty = city::all();
        // $pro = province::all();
        if(Auth::user()->name_roles == 'admin'){
            $rol = roles::where('name_roles','!=','admin')->get();
        }elseif(Auth::user()->name_roles == 'manager'){
            $rol = roles::where('name_roles','!=','admin')
                            ->where('name_roles','!=','manager')
                            ->get();
        }else{
            $rol = roles::where('name_roles','!=','admin')
                            ->where('name_roles','!=','manager')
                            ->where('name_roles','!=','staff')
                            ->get();
        }
        return view('dashboards.clients.profile-user',compact('cty','rol'));
        // return view('dashboards.clients.profile-user',compact('cty','rol','pro'));
    }
    public function edit_profile_address_user(Request $request)
    {
        $cty = city::all();
        $get = city::all()->where('id',$request->id);
        if(Auth::user()->name_roles == 'admin'){
            $rol = roles::where('name_roles','!=','admin')->get();
        }elseif(Auth::user()->name_roles == 'manager'){
            $rol = roles::where('name_roles','!=','admin')
                            ->where('name_roles','!=','manager')
                            ->get();
        }else{
            $rol = roles::where('name_roles','!=','admin')
                            ->where('name_roles','!=','manager')
                            ->where('name_roles','!=','staff')
                            ->get();
        }
        return view('dashboards.updates.profile-user-update', compact('rol','cty','get'));
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
        $roles = roles::limit(5)->paginate(5);
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
        $status = status_interior::all()->where('type_status','=','discount');
        $discount = discount::limit(5)->paginate(5);
        return view('dashboards.clients.z-discount', compact('status','discount'));
    }
    public function edit_discount_dashboard(Request $request)
    {
        $status = status_interior::all()->where('type_status','=','discount');
        $data['disc'] = discount::find($request->id);
        return view('dashboards.updates.z-discount-update',$data,compact('status'));
    }

    public function list_province_dashboard()
    {
        $province = province::limit(8)->paginate(8);
        $select_province = province::all();
        $city = city::limit(8)->paginate(8);
        return view('dashboards.clients.list-province', compact('province','city','select_province'));
    }
    public function edit_province_dashboard(Request $request)
    {
        $data['province'] = province::find($request->id);
        return view('dashboards.updates.list-province-update',$data);
    }
    public function edit_city_dashboard(Request $request)
    {
        $data['city'] = city::find($request->id);
        $select_province = province::all();
        return view('dashboards.updates.list-city-update',$data,compact('select_province'));
    }

    public function color_dashboard()
    {
        $color = color::limit(5)->paginate(5);
        return view('dashboards.clients.z-color', compact('color'));
    }
    public function edit_color_dashboard(Request $request)
    {
        $data['color'] = color::find($request->id);
        return view('dashboards.updates.z-color-update',$data);
    }
    public function history_dashboard()
    {
        $his = history::orderbyDESC('id')->limit(10)->paginate(10);
        return view('dashboards.clients.z-history', compact('his'));
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
