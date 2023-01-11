<?php

namespace App\Http\Controllers;

use App\Models\bill;
use App\Models\calendar;
use App\Models\cart;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\typestatus;
use App\Models\status_interior;
use App\Models\roles;
use App\Models\discount;
use App\Models\province;
use App\Models\city;
use App\Models\color;
use App\Models\comments;
use App\Models\favorite;
use App\Models\history;
use App\Models\supplier;
use App\Models\type_product;
use App\Models\typeproduct;
use App\Models\luong;
use App\Models\material;
use App\Models\product;
use App\Models\slide;
use App\Models\warehouse;
use Carbon\Carbon;
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
        $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $sum_bill = bill::all()->where('date_create',$today)->sum('total');
        return view('dashboards.index-dashboard', compact('sum_bill'));
    }

    public function product_dashboard()
    {
        $ware = warehouse::orderbydesc('id')->get();
        // $color = color::all();        
        return view('dashboards.clients.new-product', compact('ware'));
    }
    public function product_dashboard2(Request $request)
    {
        // $ware = warehouse::where('id',$request->id)->get();
        $data['ware'] = warehouse::find($request->id)->toArray();
        $wareAll = warehouse::orderbydesc('id')->get();
        $color = color::all();        
        return view('dashboards.clients.new-product2', $data, compact('color','wareAll'));
    }
    public function list_product_dashboard()
    {
        $product = product::limit(8)->paginate(8);
        return view('dashboards.clients.list-product', compact('product'));
    }
    public function edit_product(Request $request)
    {
        $data['product'] = product::find($request->id)->toArray();
        $color = color::all();
        return view('dashboards.updates.list-product-update', $data, compact('color'));
    }

    public function type_dashboard()
    {
        $status = status_interior::where('type_status','type_product')->get();
        return view('dashboards.clients.new-type', compact('status'));
    }
    public function list_type_dashboard()
    {
        $type = typeproduct::limit(8)->paginate(8);
        return view('dashboards.clients.list-type', compact('type'));
    }
    public function edit_type_product(Request $request)
    {
        $data['type'] = typeproduct::find($request->id)->toArray();
        $status = status_interior::where('type_status','type_product')->get();
        return view('dashboards.updates.list-type-update',compact('status'),$data);
    }

    public function supplier_dashboard()
    {
        $status = status_interior::where('type_status', 'supplier')->get();
        $supplier = supplier::limit(8)->paginate(8);
        return view('dashboards.clients.new-supplier', compact('status','supplier'));
    }
    public function edit_supplier(Request $request)
    {
        $status = status_interior::where('type_status', 'supplier')->get();
        $data['supplier'] = supplier::find($request->id)->toArray();
        return view('dashboards.updates.update-supplier', compact('status'),$data);
    }

    public function material_dashboard()
    {
        $material = material::limit(8)->paginate(8);
        $supplier = supplier::all();
        $status = status_interior::where('type_status', 'material')->get();
        return view('dashboards.clients.new-material',compact('status','material','supplier'));
    }
    public function edit_material(Request $request)
    {
        $data['material'] = material::find($request->id)->toArray();
        $supplier = supplier::all();
        $status = status_interior::where('type_status', 'material')->get();
        return view('dashboards.updates.update-material',compact('supplier','status'),$data );
    }

    public function warehouse_dashboard()
    {
        $material = material::all();
        return view('dashboards.clients.new-warehouse',compact('material'));
    }
    public function warehouse_dashboard2(Request $request)
    {
        $type = typeproduct::all();
        $material = material::where('id',$request->id)->get();
        $materialAll = material::all();
        return view('dashboards.clients.new-warehouse2',compact('type','material','materialAll'));
    }
    public function list_warehouse_dashboard()
    {
        $ware = warehouse::orderby('name')->limit(8)->paginate(8);
        return view('dashboards.clients.list-warehouse', compact('ware'));
    }
    public function edit_warehouse(Request $request)
    {
        $data['warehouse'] = warehouse::find($request->id)->toArray();
        $type = typeproduct::all();
        $mate = material::all();
        return view('dashboards.updates.warehouse_update',$data,compact('type','mate'));
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
        $user = User::limit(8)->paginate(8);
        return view('dashboards.clients.list-user',compact('user'));
    }
    //------ Chức năng xem dữ liệu user
    public function user_name_roles_us()
    {
        $user = User::where('name_roles', 'user')->limit(8)->paginate(8);
        return view('dashboards.clients.list-user',compact('user'));
    }
    public function user_interior()
    {
        $user = User::where('name_roles','!=','user')->limit(8)->paginate(8);
        return view('dashboards.clients.list-user',compact('user'));
    }
    public function user_city()
    {
        $user = User::where('name_roles','user')->orderBy('city')->limit(8)->paginate(8);
        return view('dashboards.clients.list-user',compact('user'));
    }
    public function user_province()
    {
        $user = User::where('name_roles','user')->orderBy('province')->limit(8)->paginate(8);
        return view('dashboards.clients.list-user',compact('user'));
    }
    public function user_hoatdong()
    {
        $user = User::where('name_roles','user')->where('name_status','Hoạt động')->limit(8)->paginate(8);
        return view('dashboards.clients.list-user',compact('user'));
    }
    public function user_ngat()
    {
        $user = User::where('name_roles','user')->where('name_status','Ngắt')->limit(8)->paginate(8);
        return view('dashboards.clients.list-user',compact('user'));
    }
    //---------------------------------
    public function edit_list_user(Request $request)
    {
        $up_user['user'] = User::find($request->id)->toArray();
        $pro = province::all();
        $cty = city::all();
        $status = status_interior::where('type_status','user')->get();
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
        return view('dashboards.updates.list-user-update',$up_user,compact('pro','cty','rol','status'));
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

    // public function favorite_dashboard()
    // {
    //     return view('dashboards.clients.new-favorite');
    // }
    public function list_favorite_dashboard()
    {
        $favorite = favorite::limit(10)->paginate(10);
        return view('dashboards.clients.list-favorite',compact('favorite'));
    }

    // public function cart_dashboard()
    // {
    //     return view('dashboards.clients.new-cart');
    // }
    public function list_cart_dashboard()
    {
        $cart = cart::limit(10)->paginate(10);
        return view('dashboards.clients.list-cart', compact('cart'));
    }

    public function comment_dashboard()
    {
      
        $comment = comments::limit(8)->paginate(8);

        return view('dashboards.clients.z-comment', compact('comment'));
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
    public function calendar()
    {
        // $calendar = calendar::all();
            $cld = calendar::all()->where('idu','!=','1');
            $count = count($cld);
            if ($cld == '[]') {
                $calendar = calendar::all();
            } else {
                $calendar = calendar::all()->where('idu','!=','1');
            }
            foreach($calendar as $cld){
                $check_t2 = $cld->where('t2','!=',null)->count('t2');
                $check_t3 = $cld->where('t3','!=',null)->count('t3');
                $check_t4 = $cld->where('t4','!=',null)->count('t4');
                $check_t5 = $cld->where('t5','!=',null)->count('t5');
                $check_t6 = $cld->where('t6','!=',null)->count('t6');
                $check_t7 = $cld->where('t7','!=',null)->count('t7');
                $check_cn = $cld->where('cn','!=',null)->count('cn');
                // dd($check_t2);
                return view('dashboards.calendar', compact('count','calendar','check_t2','check_t3','check_t4','check_t5','check_t6','check_t7','check_cn'));
            }
        // return view('dashboards.calendar', compact('calendar'));
    }
    public function salary()
    {
        $luong = luong::limit(8)->paginate(8);
        return view('dashboards.salary', compact('luong'));
    }
    public function slide()
    {
        $p1 = product::where('status','Còn hàng')->where('size','533x533')->get();
        $p2 = product::where('status','Còn hàng')->where('size','533x757')->get();
        $p3 = product::where('status','Còn hàng')->where('size','489x435')->get();
        $p4 = product::where('status','Còn hàng')->where('size','489x435')->get();
        $p5 = product::where('status','Còn hàng')->where('size','533x533')->get();
        $p6 = product::where('status','Còn hàng')->where('size','533x475')->get();
        $p7 = product::where('status','Còn hàng')->where('size','533x757')->get();
        $p8 = product::where('status','Còn hàng')->where('size','533x641')->get();
        $p9 = product::where('status','Còn hàng')->where('size','533x475')->get();

        $slide = slide::all();
        return view('dashboards.slide',compact('p1','p2','p3','p4','p5','p6','p7','p8','p9','slide'));
    }
    public function slide2(Request $request)
    {
        $get_pst = $request->position;
        $data['product'] = product::find($request->id)->toArray();
        $get_size = product::where('id',$request->id)->get();
        foreach($get_size as $s){
            $allProduct = product::where('status','Còn hàng')->where('size',$s->size)->get();
            return view('dashboards.slide2',$data, compact('allProduct','get_pst'));
        }
    }
    //------------------------------------------   client   -----------------------------------------
    public function index(Request $request)
    {
        $slide = slide::orderby('position')->get();
        return view('interiors.index', compact('slide'));
    }
    public function product()
    {
        $type = typeproduct::all();
        $product = product::where('status','Còn hàng')->limit(6)->paginate(6);
        return view('interiors.product', compact('type','product'));
    }
    public function new_product()
    {
        $type = typeproduct::all();
        $product = product::where('status','Còn hàng')->orderbydesc('id')->limit(5)->paginate(5);
        return view('interiors.product', compact('type','product'));
    }
    public function get_with_type(Request $request)
    {
        $type = typeproduct::all();
        $product = product::where('status','Còn hàng')->where('type_product',$request->type)->limit(6)->paginate(6);
        return view('interiors.product', compact('type','product'));
    }
    public function get_with_brand(Request $request)
    {
        $type = typeproduct::all();
        $product = product::where('status','Còn hàng')->where('supplier',$request->supp)->limit(6)->paginate(6);
        return view('interiors.product', compact('type','product'));
    }
    public function get_with_color(Request $request)
    {
        $type = typeproduct::all();
        $product = product::where('status','Còn hàng')->where('color',$request->col)->limit(6)->paginate(6);
        return view('interiors.product', compact('type','product'));
    }

    public function product_detail(Request $request)
    {
        $data['pro_detail'] = product::find($request->id)->toArray();
        return view('interiors.product-details',$data);
    }
    
    public function search_interior_client(Request $request)
    {
        $search_inter = $request['search'] ?? "";
        if($search_inter != ""){
                $product = product::where('status','Còn hàng')
                                ->where('id_product','LIKE',"%$search_inter%")
                                ->orWhere('name_product','LIKE',"%$search_inter%")
                                ->paginate(6);
                // dd($product);
        }else{
                $product = product::where('status','Còn hàng')->limit(6)->paginate(6);
                // dd($product);
        }
        $type = typeproduct::all();
        return view('interiors.product', compact('type','product','search_inter'));
    }

    public function review()
    {
        $comment = comments::limit(8)->paginate(8);
        return view('interiors.review', compact('comment'));
    }
    public function review_detail(Request $request)
    {
        $comment = comments::where('id_product',$request->id)->limit(4)->paginate(4);
        return view('interiors.review', compact('comment'));
    }
    public function review_product_detail(Request $request)
    {
        $get = product::all()->where('id_product',$request->id);
        foreach($get as $ge){
            $data['pro_detail'] = product::find($ge->id)->toArray();
            return view('interiors.product-details',$data);
        }
    }
    
    public function cart(Request $request)
    {
        $id_cart_user = 'CART_CS'.Auth::user()->user_id;
        $data_cart = cart::where('id_cart_user',$id_cart_user)->get();
        if($data_cart == '[]'){
            session()->flash('cart_null', 'Bạn chưa có sản phẩm');
            return view('interiors.cart', compact('data_cart'));
        }else{
            // $sum = cart::where('id_cart_user',$id_cart_user)->sum('total');
            $sum_not_sale = cart::where('id_cart_user',$id_cart_user)->where('sales',0)->sum('total');
            $sum_sale = cart::where('id_cart_user',$id_cart_user)->where('sales','!=',0)->sum('total_sales');
            $sum = $sum_not_sale+$sum_sale;
            // echo $sum_not_sale.','.$sum_sale.'='.$sum;
            $city = city::where('name_city', Auth::user()->city)->where('city_province', Auth::user()->province)->get();
            foreach($city as $cty){
                $ct = $cty->price;
                $sum_product_city = $sum + $ct;
                return view('interiors.cart', compact('data_cart','sum','ct','sum_product_city'));
            }
            
        }
        // dd($sum);
    }
    public function print_bill(Request $request)
    {
        $get_data_for_bill = bill::all()->where('id_bill',$request->id);
                foreach($get_data_for_bill as $gdtfb){
                    $date_bill = $gdtfb->date_create;
                    $vnp_TxnRef = $request->id;
                    $vnp_BankCode = $gdtfb->bank;
                    $vnp_BankTranNo = $gdtfb->code_bank;
                    $vnp_TransactionNo = $gdtfb->code_vnpay;
                    $vnp_CardType = $gdtfb->method;
                    
                    $name = $gdtfb->username;
                    $email = $gdtfb->email;
                    $phone = $gdtfb->phone;
                    $address = $gdtfb->address;
                    // $address = $gdtfb->method; chưa có trong dtabase
                    return view('interiors.blocks.print_bill', compact('get_data_for_bill','date_bill','vnp_TxnRef','vnp_BankCode',
                                'vnp_BankTranNo','vnp_TransactionNo','vnp_CardType','name','email','phone','address'));
                }
                // dd($get_data_for_bill);
    }
    public function favorite_user()
    {
        $favorite = favorite::where('id_user',Auth::user()->user_id)->limit(6)->paginate(6);
        if($favorite == '[]'){
            session()->flash('ck_favo','Bạn chưa có sản phẩm yêu thích');
            return redirect()->route('product');
        }else{
            return view('interiors.favorite', compact('favorite'));
        }
    }
    public function profile_user()
    {
        $bills = bill::where('email',Auth::user()->email)->orderby('id_bill')->limit(10)->paginate(10);
        // $bills = bill::where('email',Auth::user()->email)->orderbydesc('id_bill')->get();
        
        return view('interiors.profile', compact('bills'));
    }
    public function update_profile()
    {
        $data['user'] = User::find(Auth::user()->id)->toArray();
        $city_user = city::all();
        return view('interiors.blocks.update_profile', $data, compact('city_user'));
    }
    public function update_profile2(Request $request)
    {
        $city_user = city::all();
        $data['cty_user'] = city::find($request->id)->toArray();
        return view('interiors.blocks.update_profile2', $data, compact('city_user'));
    }
    public function update_profile_opCart(Request $request)
    {
        $city_user = city::all();
        $get_ct = city::all()->where('name_city', $request->id);
        foreach($get_ct as $ct){
            $data['cty_user'] = city::find($ct->id)->toArray();
            return view('interiors.blocks.update_profile2', $data, compact('city_user'));
        }
    }
    public function update_profile_get_city(Request $request)
    {
        $city_user = city::all();
        $data['cty_user'] = city::find($request->id)->toArray();
        return view('interiors.blocks.update_profile2', $data, compact('city_user'));
    }

    public function contact()
    {
        $check_u = Auth::user();
        $adm = user::all()->where('email','admin@gmail.com');
        return view('interiors.contact', compact('adm','check_u'));
    }

    public function cod403()
    {
        Auth::logout();
        session()->flash('not_user', 'Để đảm bảo an toàn chúng tôi mời bạn đăng nhập lại!!!');
        return view('dashboards.login');
    }
}