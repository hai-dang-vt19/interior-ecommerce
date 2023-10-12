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
use App\Models\comments;
use App\Models\expense;
use App\Models\favorite;
use App\Models\history;
use App\Models\supplier;
use App\Models\typeproduct;
use App\Models\luong;
use App\Models\material;
use App\Models\product;
use App\Models\slide;
use App\Models\warehouse;
use App\Models\product_famous;
use App\Models\user_famous;
use Carbon\Carbon;
use App\Models\color;
use App\Models\Hosts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class interiorController extends Controller
{
    public function _hosts(){
        $hosts = Hosts::where('active','y')->get();
        foreach($hosts as $hst){
            $host = $hst->host;
            return $host;
        }
    }
    
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
        // dd($request->all());
        $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $bill = bill::all();

        $expense = expense::all();
        $expense_msi = $expense->where('years',Carbon::now('Asia/Ho_Chi_Minh')->year);
            foreach($expense_msi as $exp_msi){
                $material = $exp_msi->expense_material;
                $get_year = $exp_msi->years;
                $salary = $exp_msi->expense_salary;
                $expense_incurred = $exp_msi->expense_incurred;
            }
        // Lợi nhuận trước thuế = Tổng doanh thu - Chi phí cố định - Chi phí phát sinh(Chưa sử dụng)

            $sum_mate_sala = $material+$salary; // Chi phí cố định

            $sum_bill_ln_ = bill::distinct()->where('status_product_bill','!=','0')->sum('total');  //Tổng doanh thu

            $total_expense = $sum_bill_ln_ - $sum_mate_sala - $expense_incurred; // Lợi nhuận trước thuế
            // echo number_format($sum_bill_ln_).'-'.number_format($sum_mate_sala).'<br>';
            // echo number_format($total_expense);return;
        // dd($strlen_te);

        $sum_today = $bill->where('date_create',$today);
        //**** Dữ liệu trong ngày  */
            $sum_bill_atm = bill::distinct()->where('method','ATM')->where('date_create',$today)->where('status_product_bill','!=','0')->sum('total');
            $sum_bill_store = bill::distinct()->where('method','STORE')->where('date_create',$today)->where('status_product_bill','!=','0')->sum('total');
            $sum_bill_cod = bill::distinct()->where('method','COD')->where('date_create',$today)->where('status_product_bill','!=','0')->sum('total');

        $sum_bill = $sum_bill_atm+$sum_bill_store+$sum_bill_cod;
         
        //**** Dữ liệu lấy để so sánh */
        // $old_day = Carbon::now('Asia/Ho_Chi_Minh')->subDays(1)->toDateString();
            $old_day = Carbon::now('Asia/Ho_Chi_Minh')->subMonth(1);
            $month = $old_day->month;
            $year = $old_day->year;

            if($month < 8){
                if($month != 2){
                    if($month % 2 == 0){      //   tháng chẵn
                        $l_dofm = '30';
                    }else{                      //    tháng lẻ
                        $l_dofm = '31';
                    }
                }else{                          // tháng 2: nhuận - thường
                    if($year % 4 == 0){
                        $l_dofm = '29';
                    }else{
                        $l_dofm = '28';
                    }
                }
            }else{
                if($month % 2 == 0){      //   tháng chẵn
                    $l_dofm = '31';
                }else{                      //    tháng lẻ
                    $l_dofm = '30';
                }
            }

            if($month < 10){
                $new_my = $year.'-0'.$month;
            }else{
                $new_my = $year.'-'.$month;
            }
            
            $f_dayOfmonth = $new_my.'-01';
            $l_dayofmonth = $new_my.'-'.$l_dofm;

                $sum_bill_atm_o = bill::distinct()->whereBetween('date_create', [$f_dayOfmonth, $l_dayofmonth])->where('method','ATM')->where('status_product_bill','!=','0')->sum('total');
                $sum_bill_store_o = bill::distinct()->whereBetween('date_create', [$f_dayOfmonth, $l_dayofmonth])->where('method','STORE')->where('status_product_bill','!=','0')->sum('total');
                $sum_bill_cod_o = bill::distinct()->whereBetween('date_create', [$f_dayOfmonth, $l_dayofmonth])->where('method','COD')->where('status_product_bill','!=','0')->sum('total');  

                $rate_sba = $sum_bill_atm-$sum_bill_atm_o;
                $rate_sbs = $sum_bill_store-$sum_bill_store_o;
                $rate_sbc = $sum_bill_cod-$sum_bill_cod_o;
            
            // $rate_sba = (($sum_bill_atm-$sum_bill_atm_o)/$sum_bill_atm_o)*100;
            // $rate_sbs = (($sum_bill_store-$sum_bill_store_o)/$sum_bill_store_o)*100;
            // $rate_sbc = (($sum_bill_cod-$sum_bill_cod_o)/$sum_bill_cod_o)*100;

        //*** doanh thu các năm */
            $get_years = Carbon::now('Asia/Ho_Chi_Minh');
            $gy = $get_years->year;
            $gy1 = $gy-1;
            $gy2 = $gy-2;

            // ATM-
                // 0
                    $sum_bill_atms_0 = bill::distinct()->where('method','ATM')->where('year_create',$gy)->where('status_product_bill','!=','0')->sum('total');
                // 1
                    $sum_bill_atms_1 = bill::distinct()->where('method','ATM')->where('year_create',$gy1)->where('status_product_bill','!=','0')->sum('total');
                // 2
                    $sum_bill_atms_2 = bill::distinct()->where('method','ATM')->where('year_create',$gy2)->where('status_product_bill','!=','0')->sum('total');
            // Store
                //0
                    $sum_bill_store_ys_0 = bill::distinct()->where('method','STORE')->where('year_create',$gy)->where('status_product_bill','!=','0')->sum('total');
                //1
                    $sum_bill_store_ys_1 = bill::distinct()->where('method','STORE')->where('year_create',$gy1)->where('status_product_bill','!=','0')->sum('total');
                //2
                    $sum_bill_store_ys_2 = bill::distinct()->where('method','STORE')->where('year_create',$gy2)->where('status_product_bill','!=','0')->sum('total');
            // COD
                //0
                    $sum_bill_cod_ys_0 = bill::distinct()->where('method','COD')->where('year_create',$gy)->where('status_product_bill','!=','0')->sum('total'); // 3
                //1
                    $sum_bill_cod_ys_1 = bill::distinct()->where('method','COD')->where('year_create',$gy1)->where('status_product_bill','!=','0')->sum('total'); // 3
                //2
                    $sum_bill_cod_ys_2 = bill::distinct()->where('method','COD')->where('year_create',$gy2)->where('status_product_bill','!=','0')->sum('total'); // 3

                $charts_0 = "['".$gy."', ".$sum_bill_atms_0.", ".$sum_bill_store_ys_0.", ".$sum_bill_cod_ys_0."],";
                $charts_1 = "['".$gy1."', ".$sum_bill_atms_1.", ".$sum_bill_store_ys_1.", ".$sum_bill_cod_ys_1."],";
                $charts_2 = "['".$gy2."', ".$sum_bill_atms_2.", ".$sum_bill_store_ys_2.", ".$sum_bill_cod_ys_2."],";
            
                $sum_bill_y = $sum_bill_atms_0+$sum_bill_store_ys_0+$sum_bill_cod_ys_0;
                $sum_bill_y1 = $sum_bill_atms_1+$sum_bill_store_ys_1+$sum_bill_cod_ys_1;
                $sum_bill_y2 = $sum_bill_atms_2+$sum_bill_store_ys_2+$sum_bill_cod_ys_2;

                $char_ck0 = "['".$gy."',     ".$sum_bill_y."],";
                $char_ck1 = "['".$gy1."',     ".$sum_bill_y1."],";
                $char_ck2 = "['".$gy2."',     ".$sum_bill_y2."],";
            //
        //*** Top 5 sản phẩm bán chạy */
        $date_famous = Carbon::now('Asia/Ho_Chi_Minh');
        $month_famous = $date_famous->month;
        $year_famous = $date_famous->year;
        // echo $month_famous.'<BR>'.$year_famous; return;

        $get_pr_famous = product_famous::where('month_c',$month_famous)
                        ->where('year_c',$year_famous)
                        ->orderbyDESC('amount_bill')
                        ->take(5)->get();
        //*** top usser */
            $get_user_ftop1 = user_famous::where('month_c',$month_famous)
                            ->where('year_c',$year_famous)
                            ->orderbyDESC('amount_user')
                            ->take(1)->get();
            $get_user_price_ftop1 = user_famous::where('month_c',$month_famous)
                            ->where('year_c',$year_famous)
                            ->orderbyDESC('total')
                            ->take(1)->get();
            if($get_user_ftop1 != "[]"){
                foreach($get_user_ftop1 as $get_uftop1){
                    $get_list_user_ftop1 = user_famous::where('month_c',$month_famous)
                    ->where('year_c',$year_famous)
                    ->where('user_id','!=',$get_uftop1->user_id)
                    ->orderbyDESC('amount_user')
                    ->take(4)
                    ->get();
                }
                foreach($get_user_price_ftop1 as $get_price_uftop1){
                    $get_list_user_price_ftop1 = user_famous::where('month_c',$month_famous)
                    ->where('year_c',$year_famous)
                    ->where('user_id','!=',$get_price_uftop1->user_id)
                    ->orderbyDESC('total')
                    ->take(4)
                    ->get();
                }
            }else{
                $get_list_user_ftop1 = user_famous::orderbyDESC('amount_user')
                    ->take(4)
                    ->get();
                $get_list_user_price_ftop1 = user_famous::orderbyDESC('total')
                    ->take(4)
                    ->get();
            } 
        //** */
        return view('dashboards.index-dashboard', compact(
            'sum_bill','total_expense','sum_bill_atm','sum_bill_store','sum_bill_cod','rate_sba',
            'rate_sbs','rate_sbc','sum_bill_y','charts_0','charts_1','charts_2','char_ck0','char_ck1','char_ck2',
            'get_pr_famous','get_user_ftop1','get_user_price_ftop1','get_list_user_ftop1','get_list_user_price_ftop1',
            'expense'
        ));
    }
    
    public function index_chart(){
        return view('dashboards.chart');
    }
    
    public function index_ExpenseYear(Request $request){
        $y1 = $request->y1;
        $type_product = $request->type_product;
        $phone = $request->phone;
        $ck_y = $request->ck_y;
        // dd($request->all());
        
        if($request->status_y > 0){
            $stt_l = '>'; $stt_b = '0';
        }else{
            $stt_l = '='; $stt_b = '0';
        }
        
        if (!empty($y1)) {
            $y1 = explode(' to ',$y1);
            if(count($y1)==2){
                if(!empty($ck_y)){
                    $y1_a = Carbon::parse($y1[0])->year.'-01-01';
                    $y1_b = Carbon::parse($y1[1])->year.'-12-31';
                    if($y1_a == $y1_b){ 
                        $y1_title = $y1_a;
                    }else{ 
                        $y1_title = $y1_a.'-'.$y1_b; 
                    }
                }else{
                    $y1_title =  Carbon::parse($y1[0])->format('m-Y').'-'.Carbon::parse($y1[1])->format('m-Y');
                    $y1_a = Carbon::parse($y1[0])->toDateString();
                    $y1_b = Carbon::parse($y1[1])->toDateString();
                }
            }elseif (count($y1)==1) {
                $y1_title = Carbon::parse($y1[0])->format('d-m-Y');
                if (!empty($ck_y)) {
                    $y1_a = Carbon::parse($y1[0])->year.'-01-01';
                    $y1_b = Carbon::parse($y1[0])->year.'-12-31';
                } else {
                    $y1_a = Carbon::parse($y1[0])->toDateString();
                    $y1_b = $y1_a;
                }
            }
        }
        if($request->radioMethod_year == '0'){
            
            $sum_atm = bill::distinct()->where('status_product_bill',$stt_l,$stt_b)->where('method','ATM')->wherebetween('date_create', [$y1_a,$y1_b]);
            $sum_store = bill::distinct()->where('status_product_bill',$stt_l,$stt_b)->where('method','STORE')->wherebetween('date_create', [$y1_a,$y1_b]);
            $sum_cod = bill::distinct()->where('status_product_bill',$stt_l,$stt_b)->where('method','COD')->wherebetween('date_create', [$y1_a,$y1_b]);
            if ($type_product == 'all') {
                if (empty($phone)) {
                    $data_atm = $sum_atm->sum('total');
                    $data_store = $sum_store->sum('total');
                    $data_cod = $sum_cod->sum('total');
                } else {
                    $data_atm = $sum_atm->where('phone',$phone)->sum('total');
                    $data_store = $sum_store->where('phone',$phone)->sum('total');
                    $data_cod = $sum_cod->where('phone',$phone)->sum('total');
                }
                
            } else {
                if(empty($phone)){
                    $data_atm = $sum_atm->where('type_product',$type_product)->sum('total');
                    $data_store = $sum_store->where('type_product',$type_product)->sum('total');
                    $data_cod = $sum_cod->where('type_product',$type_product)->sum('total');
                }else{
                    $data_atm = $sum_atm->where('type_product',$type_product)->where('phone')->sum('total');
                    $data_store = $sum_store->where('type_product',$type_product)->where('phone')->sum('total');
                    $data_cod = $sum_cod->where('type_product',$type_product)->sum('total');
                }
            }
            if (empty($phone)) {
                if ($type_product == 'all') {
                    $data_atm = $sum_atm->sum('total');
                    $data_store = $sum_store->sum('total');
                    $data_cod = $sum_cod->sum('total');
                } else {
                    $data_atm = $sum_atm->where('type_product',$type_product)->sum('total');
                    $data_store = $sum_store->where('type_product',$type_product)->sum('total');
                    $data_cod = $sum_cod->where('type_product',$type_product)->sum('total');
                }
            } else {
                if ($type_product == 'all') {
                    $data_atm = $sum_atm->where('phone',$phone)->sum('total');
                    $data_store = $sum_store->where('phone',$phone)->sum('total');
                    $data_cod = $sum_cod->where('phone',$phone)->sum('total');
                } else {
                    $data_atm = $sum_atm->where('phone',$phone)->where('type_product',$type_product)->sum('total');
                    $data_store = $sum_store->where('phone',$phone)->where('type_product',$type_product)->sum('total');
                    $data_cod = $sum_cod->where('phone',$phone)->where('type_product',$type_product)->sum('total');
                }
            }
            
            $des = "['', 'ATM', 'STORE', 'COD'],";
            $charts = "['".$y1_title."', '".number_format($data_atm)."', '".number_format($data_store)."', '".number_format($data_cod)."'],";

            $charts2 = "['ATM',".$data_atm."],['STORE',".$data_store."],['COD',".$data_cod."]";
        }else{
            $methodYear = $request->radioMethod_year;
            $bill_year1 = bill::distinct()->where('status_product_bill',$stt_l,$stt_b)->where('method',$methodYear)->wherebetween('date_create', [$y1_a,$y1_b]);
            // $sum = $bill_year1->sum('total');
            if (empty($phone)) {
                if ($type_product == 'all') {
                    $sum = $bill_year1->sum('total');
                } else {
                    $sum = $bill_year1->where('type_product',$type_product)->sum('total');
                }
            } else {
                if ($type_product == 'all') {
                    $sum = $bill_year1->where('phone',$phone)->sum('total');
                } else {
                    $sum = $bill_year1->where('phone',$phone)->where('type_product',$type_product)->sum('total');
                }
            }
            $des = "['', 'All'],";
            $charts = "['".$y1_title."', '".number_format($sum)."'],";
            $charts2 = "['ALL',".$sum."]";
        } 
        
        // return;
    
        return view('dashboards.chart', compact('charts','des','charts2'));
    }

    public function detail_with_method_dash(Request $request)
    {
        $time = Carbon::now('Asia/Ho_Chi_Minh')->year;
        $methods = $request->method;
        $bill = bill::where('method',$request->method)->where('year_create',$time)->limit(20)->paginate(20);
        return view('dashboards.block_dashboard.modal_with_method',compact('bill','methods'));
    }
    
    public function detail_bill(Request $request)
    {
        $bill = bill::all()->where('id_bill',$request->id);
        $product = product::all();
        return view('dashboards.block_dashboard.bill_detail',compact('bill','product'));
    }

    public function create_bill_dashboard(Request $request)
    {
        $product_slt = product::all()->where('status','Còn hàng');
        $data = $request->data;
        $product = product::all()->where('id_product',$data);
        $cart = cart::all()->where('id_cart_user','STORE-'.Auth::user()->user_id);
        $sum_cart = cart::where('id_cart_user','STORE-'.Auth::user()->user_id)->sum('total_sales');
        return view('dashboards.clients.new-bill', compact('product_slt','product','cart','sum_cart'));
    }

    public function product_dashboard()
    {
        $ware = warehouse::orderbydesc('id')->get();
        return view('dashboards.clients.new-product', compact('ware'));
    }
    public function product_dashboard2(Request $request)
    {
        // $ware = warehouse::where('id',$request->id)->get();
        $data['ware'] = warehouse::find($request->id)->toArray();
        $wareAll = warehouse::orderbydesc('id')->get();
        return view('dashboards.clients.new-product2', $data, compact('wareAll'));
    }
    public function list_product_dashboard()
    {
        $product = product::limit(8)->paginate(8);
        return view('dashboards.clients.list-product', compact('product'));
    }
    public function edit_product(Request $request)
    {
        $data['product'] = product::find($request->id)->toArray();
        return view('dashboards.updates.list-product-update', $data);
    }

    public function list_type_dashboard()
    {
        $type = typeproduct::limit(8)->paginate(8);
        $status = status_interior::where('type_status','type_product')->get();
        return view('dashboards.clients.list-type', compact('type','status'));
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
    public function fill_list_user(Request $req){
        $ex_date = explode(' to ', $req->date_fill);
        if(empty($req->date_fill)){
            if(empty($req->city_fill)){
                // return 1;
                $user = User::where('name_roles',$req->roles_fill)
                    ->where('name_status',$req->status_fill)
                    // ->where('city',$req->city_fill)
                    // ->whereBetween('created_at', [$ex_date[0], $ex_date[1]])
                    ->limit($req->number_page)->simplePaginate($req->number_page);
            }else{
                $user = User::where('name_roles',$req->roles_fill)
                    ->where('name_status',$req->status_fill)
                    ->where('city',$req->city_fill)
                    // ->whereBetween('created_at', [$ex_date[0], $ex_date[1]])
                    ->limit($req->number_page)->simplePaginate($req->number_page);
            }
        }else{
            $time_f = Carbon::parse($ex_date[0])->toDateString();
            if(!empty($ex_date[1])){
                $time_l = Carbon::parse($ex_date[1])->toDateString();
                if (empty($req->city_fill)) {
                    $user = User::where('name_roles',$req->roles_fill)
                        ->where('name_status',$req->status_fill)
                        ->whereBetween('updated_at', [$time_f, $time_l])
                        ->limit($req->number_page)->simplePaginate($req->number_page);
                } else {
                    $user = User::where('name_roles',$req->roles_fill)
                        ->where('name_status',$req->status_fill)
                        ->where('city',$req->city_fill)
                        ->whereBetween('updated_at', [$time_f, $time_l])
                        ->limit($req->number_page)->simplePaginate($req->number_page);
                }    
            }else{
                if (empty($req->city_fill)) {
                    $user = User::where('name_roles',$req->roles_fill)
                        ->where('name_status',$req->status_fill)
                        ->where('updated_at', $time_f)
                        ->limit($req->number_page)->simplePaginate($req->number_page);
                } else {
                    $user = User::where('name_roles',$req->roles_fill)
                        ->where('name_status',$req->status_fill)
                        ->where('city',$req->city_fill)
                        ->where('updated_at', $time_f)
                        ->limit($req->number_page)->simplePaginate($req->number_page);
                }
            }
                    
        }
        // dd($user->links());

        return view('dashboards.clients.list-user',compact('user'));
    }
    // public function user_name_roles_us()
    // {
    //     $user = User::where('name_roles', 'user')->limit(8)->paginate(8);
    //     return view('dashboards.clients.list-user',compact('user'));
    // }
    // public function user_interior()
    // {
    //     $user = User::where('name_roles','!=','user')->limit(8)->paginate(8);
    //     return view('dashboards.clients.list-user',compact('user'));
    // }
    // public function user_city()
    // {
    //     $user = User::where('name_roles','user')->orderBy('city')->limit(8)->paginate(8);
    //     return view('dashboards.clients.list-user',compact('user'));
    // }
    // public function user_province()
    // {
    //     $user = User::where('name_roles','user')->orderBy('province')->limit(8)->paginate(8);
    //     return view('dashboards.clients.list-user',compact('user'));
    // }
    // public function user_hoatdong()
    // {
    //     $user = User::where('name_roles','user')->where('name_status','Hoạt động')->limit(8)->paginate(8);
    //     return view('dashboards.clients.list-user',compact('user'));
    // }
    // public function user_ngat()
    // {
    //     $user = User::where('name_roles','user')->where('name_status','Ngắt')->limit(8)->paginate(8);
    //     return view('dashboards.clients.list-user',compact('user'));
    // }
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
        // $comment = comments::all();
        // $comment = comments::limit(12)->paginate(12);
        $comment = DB::table('comments')
                          ->join('users','comments.id_user','=','users.user_id')
                          ->select('comments.*','users.*')
                          ->limit(12)->paginate(12);
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
    public function history_dashboard()
    {
        $his = history::orderbyDESC('id')->limit(10)->paginate(10);
        return view('dashboards.clients.z-history', compact('his'));
    }
    public function salary()
    {
        $luong = luong::limit(8)->paginate(8);
        return view('dashboards.salary', compact('luong'));
    }
    public function slide()
    {
        $sl_position400 = product::where('status','Còn hàng')->where('size','Position400')->get();
        $slide = slide::all();
        
        return view('dashboards.slide',compact('sl_position400','slide'));
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

    public function search_dashboard_up(Request $request)
    {
        if ($request->check_kh == 1) {
            $product = product::where('id_product','LIKE','%'.$request->data_search)
                                ->orwhere('name_product','LIKE','%'.$request->data_search.'%')
                                ->limit(8)->paginate(8);
            return view('dashboards.clients.list-product', compact('product'));
        } elseif($request->check_kh == 2) {
            $bill = bill::all()->where('id_bill',$request->data_search);
            $ck_bill = bill::where('id_bill','LIKE',$request->data_search);
            $count_xl_ = bill::all()->where('status_product_bill','1')->count();
            $count_vc_ = bill::all()->where('status_product_bill','2')->count();
            $count_hd_ = bill::all()->where('status_product_bill','3')->count();
            $product_ = product::all()->where('status','Còn hàng');
            if($bill == '[]'){
                session()->flash('warning','Bạn chưa nhập đơn hàng');
                return back();
            }else{
                foreach($bill as $bills){
                    if ($bills->status_product_bill == "1") {
                        $bill_xuly = $ck_bill->where('status_product_bill','1')->limit(10)->paginate(10);
                        $count_xl = $count_xl_;
                        $count_vc = $count_vc_;
                        $count_hd = $count_hd_;
                        $product = $product_;
                        return view('dashboards.clients.list-bill', compact('bill_xuly','count_xl','count_vc','count_hd','product'));
                    } elseif($bills->status_product_bill == "2") {
                        $bill_vanchuyen = $ck_bill->where('status_product_bill','2')->limit(10)->paginate(10);
                        $count_xl = $count_xl_;
                        $count_vc = $count_vc_;
                        $count_hd = $count_hd_;
                        $product = $product_;
                        return view('dashboards.clients.list-bill-vanchuyen', compact('bill_vanchuyen','count_xl','count_vc','count_hd','product'));
                    } elseif($bills->status_product_bill == "3") {
                        $bill_hangden = $ck_bill->where('status_product_bill','3')->limit(10)->paginate(10);
                        $count_xl = $count_xl_;
                        $count_vc = $count_vc_;
                        $count_hd = $count_hd_;
                        $product = $product_;
                        return view('dashboards.clients.list-bill-hangden', compact('bill_hangden','count_xl','count_vc','count_hd','product'));            
                    } else {
                        $bill_thanhcong = $ck_bill->where('status_product_bill', '4')->limit(10)->paginate(10);
                        $count_xl = $count_xl_;
                        $count_vc = $count_vc_;
                        $count_hd = $count_hd_;
                        $product = $product_;
                        return view('dashboards.clients.list-bill-thanhcong', compact('bill_thanhcong','count_xl','count_vc','count_hd','product'));
                    }
                }
            }
        } else {
            $user = User::where('user_id','LIKE','%'.$request->data_search)
                         ->orwhere('name','LIKE','%'.$request->data_search.'%')
                         ->limit(8)->paginate(8);
            return view('dashboards.clients.list-user',compact('user'));
        }
        
    }

    // public function test_api_map()
    // {
    //     $key = 'AIzaSyCiaJz_47PO1h12WOaRs8b5u3rVbCr13co';
    //     $link = 'https://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&key='.$key;
    //     return redirect($link);
    // }
    //------------------------------------------   client   -----------------------------------------
        public function _type_product(){
            $types = typeproduct::all()->where('type_status','Còn hàng');
            return $types;
        }
        public function _supplier_product(){
            $suppliers = supplier::all()->where('status_supplier','!=','Ngắt');
            return $suppliers;
        }
        public function _color_product()
        {
            $color = color::distinct('color')->get('id_color');
            return $color;
        }
        public function _cart(){
            if(!empty(Auth::user())){
                $cart = cart::orderbydesc('id')->where('id_cart_user','CART_CS'.Auth::user()->user_id);
            }else{
                $cart = null;
            }
            return $cart;
        }
        public function _comment(){
            $comment = comments::orderbydesc('id')->take(20)->get();
            return $comment;
        }

    public function index(Request $request)
    {
        $types = $this->_type_product();
        $suppliers = $this->_supplier_product();
        $carts = $this->_cart();
        $comment = $this->_comment();
        // dd($comment);

        $product_9slide = slide::whereBetween('position', [1, 9])->get();
        $head_slide = slide::all()->where('position','0');         
        $max = product::where('status','Còn hàng')->max('price');
        // echo $head_slide;return;
        return view('interiors.index', compact('types','comment','max','suppliers','product_9slide','head_slide','carts'));
    }
    public function product()
    {
        $types = $this->_type_product();
        $suppliers = $this->_supplier_product();
        $color = $this->_color_product();
        $carts = $this->_cart();
        $comment = $this->_comment();

        $pr_inte = product::where('status','Còn hàng');
        $product = $pr_inte->limit(12)->paginate(12);
         
        $max = $pr_inte->max('price');

        return view('interiors.product', compact('types','comment','suppliers','product','max' ,'color','pr_inte','carts'));
    }
    public function product_with_price(Request $req)
    {
        $arr = explode(' - ',$req->data);
        // print_r($arr);return;
        $p1_ = $arr[0];
        $p2_ = $arr[1];
        $p1_explode = explode(',',$p1_);
        $p2_explode = explode(',',$p2_);
        $count_p1_ex = count($p1_explode);
        $count_p2_ex = count($p2_explode);
        
        if($count_p1_ex == 1){// nghìn -> trăm
            $p1 = $p1_explode[0];
        }elseif($count_p1_ex == 2){// triệu -> trăm triệu
            $p1 = $p1_explode[0].$p1_explode[1];
        }else{
            $p1 = $p1_explode[0].$p1_explode[1].$p1_explode[2];
        }
        if($count_p2_ex == 1){// nghìn -> trăm
            $p2 = $p2_explode[0];
        }elseif($count_p2_ex == 2){// triệu -> trăm triệu
            $p2 = $p2_explode[0].$p2_explode[1];
        }else{
            $p2 = $p2_explode[0].$p2_explode[1].$p2_explode[2];
        }
        $types = $this->_type_product();
        $suppliers = $this->_supplier_product();
        $color = $this->_color_product();
        $carts = $this->_cart();
        $comment = $this->_comment();

        $pr_inte = product::where('status','Còn hàng');
         
        $max = $pr_inte->max('price');
        $products = $pr_inte->whereBetween('price', [$p1, $p2]);
        $c = $products->count();
        $product = $products->limit($c)->paginate($c);
        
        return view('interiors.product', compact('types','comment','suppliers','product','max' ,'color','pr_inte','carts'));
    }
    public function get_with_type(Request $request)
    {
        $types = $this->_type_product();
        $suppliers = $this->_supplier_product();
        $color = $this->_color_product();
        $carts = $this->_cart();
        $comment = $this->_comment();

        $pr_inte = product::where('status','Còn hàng');
         
        $max = $pr_inte->max('price');

        $product = $pr_inte->where('type_product',$request->type)->limit(12)->paginate(12);

        return view('interiors.product', compact('types','comment','suppliers','product','max' ,'color','pr_inte','carts'));
    }
    // public function get_with_brand(Request $request)
    // {
    //     $types = $this->_type_product();
    //     $suppliers = $this->_supplier_product();
    //     $color = $this->_color_product();
    //     $carts = $this->_cart();
    //     $comment = $this->_comment();

    //     $pr_inte = product::where('status','Còn hàng');
         
    //     $max = $pr_inte->max('price');

    //     $product = $pr_inte->where('supplier',$request->supplier)->limit(12)->paginate(12);

    //     return view('interiors.product', compact('types','comment','suppliers','product','max' ,'color','pr_inte','carts'));
    // }
    // public function get_with_color(Request $request)
    // {
    //     $types = $this->_type_product();
    //     $suppliers = $this->_supplier_product();
    //     $color = $this->_color_product();
    //     $carts = $this->_cart();
    //     $comment = $this->_comment();

    //     $pr_inte = product::where('status','Còn hàng');
         
    //     $max = $pr_inte->max('price');

    //     $product = $pr_inte->where('color','like',"%$request->color%")->limit(12)->paginate(12);

    //     return view('interiors.product', compact('types','comment','suppliers','product','max' ,'color','pr_inte','carts'));
    // }
    public function loc_product(Request $request)
    {
        $types = $this->_type_product();
        $suppliers = $this->_supplier_product();
        $color = $this->_color_product();
        $carts = $this->_cart();
        $comment = $this->_comment();

        $pr_inte = product::where('status','Còn hàng');
         
        $max = $pr_inte->max('price');

        $product = product::where('status','Còn hàng')
                            ->where('color','like',"%$request->color%")
                            ->where('type_product',$request->typeproduct)
                            ->whereBetween('price', [1, $request->ran_price])
                            ->limit(12)->paginate(12);
        return view('interiors.product', compact('types','comment','suppliers','product','max' ,'color','pr_inte','carts'));
    }
    public function get_a_z()
    {
        $types = $this->_type_product();
        $suppliers = $this->_supplier_product();
        $color = $this->_color_product();
        $carts = $this->_cart();
        $comment = $this->_comment();

        $pr_inte = product::where('status','Còn hàng');
         
        $max = $pr_inte->max('price');

        $product = $pr_inte->orderby('name_product')->limit(12)->paginate(12);

        return view('interiors.product', compact('types','comment','suppliers','product','max' ,'color','pr_inte','carts'));
    }
    public function get_z_a()
    {
        $types = $this->_type_product();
        $suppliers = $this->_supplier_product();
        $color = $this->_color_product();
        $carts = $this->_cart();
        $comment = $this->_comment();

        $pr_inte = product::where('status','Còn hàng');
         
        $max = $pr_inte->max('price');

        $product = $pr_inte->orderbydesc('name_product')->limit(12)->paginate(12);

        return view('interiors.product', compact('types','comment','suppliers','product','max' ,'color','pr_inte','carts'));
    }

    // public function product_detail(Request $request)
    // {
    //     $pr_inte = product::where('status','Còn hàng');
    //     $data['pro_detail'] = product::find($request->id)->toArray();
    //     return view('interiors.product-details',$data, compact('pr_inte'));
    // }
    
    public function search_interior_client(Request $request)
    {
        // dd($request->all());
        $pr_inte = product::where('status','Còn hàng');
        $max = $pr_inte->max('price');
        $search_inter = $request['key'] ?? "";
        $arrMin = [$request->min];
        $arrMax = [$request->max];
        $type = $request->types_nav;

        if($search_inter != ""){
                if(!empty($request->check)){
                    $product = $pr_inte->Where('name_product','LIKE',"%$search_inter%")->orWhere('id_product','LIKE',"%$search_inter")
                                        ->where('type_product',$type)
                                        ->whereBetween('price',[$arrMin, $arrMax])
                                        ->limit(12)
                                        ->paginate(12);
                }else{
                    $product = $pr_inte->Where('name_product','LIKE',"%$search_inter%")->orWhere('id_product','LIKE',"%$search_inter")
                                        ->limit(12)
                                        ->paginate(12);
                }
                // dd($product);
        }else{
                $product = $pr_inte->limit(12)->paginate(12);
                // dd($product);
        }
        $types = $this->_type_product();
        $suppliers = $this->_supplier_product();
        $color = $this->_color_product();
        $carts = $this->_cart();
        $comment = $this->_comment();

        return view('interiors.product', compact('color','comment','types','suppliers','product','search_inter' ,'max','pr_inte','carts'));
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
        $types = $this->_type_product();
        $suppliers = $this->_supplier_product();
        $carts = $this->_cart();
        $comment = $this->_comment();
        $max = product::where('status','Còn hàng')->max('price');

        $check_adress = User::all()->where('user_id',Auth::user()->user_id);
        // echo $check_adress;return;
        foreach($check_adress as $check_ad){
            $check_city = $check_ad->city;
            $check_province = $check_ad->province;
            // $check_district = $check_ad->district;
            $check_phone = $check_ad->phone;
            if($check_city  == null){
                session()->flash('error2','Bạn cần nhập địa chỉ');
                return redirect()->route('profile');
            }elseif($check_province == null){
                session()->flash('error2','Bạn cần nhập địa chỉ');
                return redirect()->route('profile');
            }elseif($check_phone == null){
                session()->flash('error2','Bạn cần nhập số điện thoại');
                return redirect()->route('profile');
            }else{
                $id_cart_user = 'CART_CS'.Auth::user()->user_id;

                if(empty($request->id_product)){
                    $data_cart = cart::where('id_cart_user',$id_cart_user);
                }else{
                    $data_cart = cart::where('id_cart_user',$id_cart_user)->where('id_product',$request->id_product);
                }
                if($data_cart == '[]'){
                    session()->flash('warning', 'Bạn chưa có sản phẩm');
                    return view('interiors.cart', compact('data_cart'));
                }else{
                    // $sum = cart::where('id_cart_user',$id_cart_user)->sum('total');
                    if(empty($request->id_product)){
                        $sum_not_sale = cart::where('id_cart_user',$id_cart_user)->where('sales',0)->sum('total');
                        $sum_sale = cart::where('id_cart_user',$id_cart_user)->where('sales','!=',0)->sum('total_sales');
                        $sum = $sum_not_sale+$sum_sale;
                        // echo $sum_not_sale.','.$sum_sale.'='.$sum;
                        $city = city::where('name_city', Auth::user()->city)->where('city_province', Auth::user()->province)->get();
                    }else{
                        $sum_not_sale = cart::where('id_cart_user',$id_cart_user)
                                            ->where('id_product',$request->id_product)
                                            ->where('sales',0)
                                            ->sum('total');
                        $sum_sale = cart::where('id_cart_user',$id_cart_user)
                                            ->where('id_product',$request->id_product)
                                            ->where('sales','!=',0)
                                            ->sum('total_sales');
                        $sum = $sum_not_sale+$sum_sale;
                        // echo $sum_not_sale.','.$sum_sale.'='.$sum;
                        $city = city::where('name_city', Auth::user()->city)->where('city_province', Auth::user()->province)->get();
                    }
                    foreach($city as $cty){
                        $ct = $cty->price;
                        // $sum_product_city = $sum + $ct;
                        return view('interiors.cart', compact('data_cart','comment','carts','sum','sum_not_sale','sum_sale','ct','suppliers','types','max'));
                    }
                }
            }
        }
    }

    public function bill(){
        $bill = bill::where('email',Auth::user()->email);
        $types = $this->_type_product();
        $suppliers = $this->_supplier_product();
        $carts = $this->_cart();
        $comment = $this->_comment();
        $max = product::where('status','Còn hàng')->max('price');


        return view('interiors.bill', compact('bill','types','comment','suppliers','carts','max'));
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
        $types = $this->_type_product();
        $suppliers = $this->_supplier_product();
        $carts = $this->_cart();
        $comment = $this->_comment();
        // $color = $this->_color_product();

        $pr_inte = product::where('status','Còn hàng');
        $max = $pr_inte->max('price');

        $favorites = favorite::where('id_user',Auth::user()->user_id);
        // dd($favorites->get());
        if($favorites->get() == '[]'){
            session()->flash('warning','Bạn chưa có sản phẩm yêu thích');
            return redirect()->route('product');
        }else{
            $favorite = $favorites->limit(10)->paginate(10);
            return view('interiors.favorite', compact('favorite','comment','types','suppliers','max','carts'));
        }
    }
    public function profile_user()
    {
        $bills = bill::where('email',Auth::user()->email)->orderby('id_bill')->limit(10)->paginate(10);
        // $bills = bill::where('email',Auth::user()->email)->orderbydesc('id_bill')->get();
        
        return view('interiors.profile', compact('bills'));
    }
    // public function update_profile()
    // {
    //     $data['user'] = User::find(Auth::user()->id)->toArray();
    //     $city_user = city::all();
    //     return view('interiors.blocks.update_profile', $data, compact('city_user'));
    // }
    // public function update_profile2(Request $request)
    // {
    //     $city_user = city::all();
    //     $data['cty_user'] = city::find($request->id)->toArray();
    //     return view('interiors.blocks.update_profile2', $data, compact('city_user'));
    // }
    // public function update_profile_opCart(Request $request)
    // {
    //     $city_user = city::all();
    //     $get_ct = city::all()->where('name_city', $request->id);
    //     foreach($get_ct as $ct){
    //         $data['cty_user'] = city::find($ct->id)->toArray();
    //         return view('interiors.blocks.update_profile2', $data, compact('city_user'));
    //     }
    // }
    // public function update_profile_get_city(Request $request)
    // {
    //     $city_user = city::all();
    //     $data['cty_user'] = city::find($request->id)->toArray();
    //     return view('interiors.blocks.update_profile2', $data, compact('city_user'));
    // }

    public function contact()
    {
        $types = $this->_type_product();
        $suppliers = $this->_supplier_product();
        $carts = $this->_cart();
        $comment = $this->_comment();

        $pr_inte = product::where('status','Còn hàng');
         
        $max = $pr_inte->max('price');

        return view('interiors.contact', compact('comment','types','suppliers','max','carts'));
    }

    public function profile()
    {
        $types = $this->_type_product();
        $suppliers = $this->_supplier_product();
        $carts = $this->_cart();
        $comment = $this->_comment();

        $pr_inte = product::where('status','Còn hàng');
        $max = $pr_inte->max('price');

        $city = city::all();

        return view('interiors.profile', compact('comment','types','suppliers','max','carts','city'));
    }

    public function cod403()
    {
        Auth::logout();
        session()->flash('error', 'Để đảm bảo an toàn chúng tôi mời bạn đăng nhập lại!!!');
        return view('dashboards.login');
    }

    // public function export_excel_bill()
    // {
    //     $time = Carbon::now('Asia/Ho_Chi_Minh');
    //     return Excel::download(new BillExport(), 'Don_hang_'.$time->day.'_'.$time->month.'_'.$time->year.'.xlsx');
    // }
    public function rdr_QrCode(Request $req) {
        // dd($req->id);
        if (empty(Auth::user())) {
            $url = $this->_hosts().'interior-product-srh?key='.$req->id;
            return redirect($url);
        } else {
            if (Auth::user()->name_roles == 'user') {
                $url = $this->_hosts().'interior-product-srh?key='.$req->id;
                return redirect($url);
            } else {
                $url = $this->_hosts().'new-bill?data='.$req->id;
                return redirect($url);
            }
        }
    }

    public function lst_api(){
        return view('dashboards.clients.z-api');
    }
    
}