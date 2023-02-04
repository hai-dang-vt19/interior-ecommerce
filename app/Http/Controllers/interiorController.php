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
use App\Models\expense;
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
use App\Models\product_famous;
use App\Models\user_famous;
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
        $bill = bill::all();

        $expense = expense::all();
        $expense_material = $expense->where('years',Carbon::now('Asia/Ho_Chi_Minh')->year);
            foreach($expense_material as $exp_mate){
                $material = $exp_mate->expense_material;
                $get_year = $exp_mate->years;
            }
            $expense_salary = $expense->where('years',Carbon::now('Asia/Ho_Chi_Minh')->year);
            foreach($expense_salary as $exp_sala){
                $salary = $exp_sala->expense_salary;
            }
        // Lợi nhuận trước thuế = Tổng doanh thu - Chi phí cố định - Chi phí phát sinh(Chưa sử dụng)
            $sum_mate_sala = $material+$salary; // Chi phí cố định
            // $sum_bill_ln = $bill->where('date_create',$get_year);
            $s_amount = bill::all()->where('amount','=','1')->sum('amount');
            $s_price = bill::all()->where('amount','=','1')->sum('price');
            $s_pr_service = bill::all()->where('amount','=','1')->sum('price_service');
            if($s_amount && $s_price != 0){
                    $s_amount_ = ($s_amount/$s_amount)*$s_price + $s_pr_service; //tong doanh thu = 1
                }else{
                    $s_amount_ = 0;
            }
            $s_amount_not_1 = bill::all()->where('amount','!=','1')->sum('amount');
            $s_price_not_1 = bill::where('amount','!=','1')->distinct()->sum('price');
            $s_pr_service_not_1 = bill::all()->where('amount','!=','1')->sum('price_service');
            $sum_price_sba_not_1 = $s_price_not_1*$s_amount_not_1 + $s_pr_service_not_1; // tong doanh thu != 1

            $sum_bill_ln_ = $s_amount_+$sum_price_sba_not_1;  //Tổng doanh thu
            $total_expense = $sum_bill_ln_-$sum_mate_sala;
        // dd($strlen_te);

        $sum_today = $bill->where('date_create',$today);
        //**** Dữ liệu trong ngày  */
        // ATM
            $sba_1 = $sum_today->where('method','ATM')->where('amount','=','1')->sum('amount');
            $sba_2 = $sum_today->where('method','ATM')->where('amount','=','1')->sum('price');
            $sba_3 = $sum_today->where('method','ATM')->where('amount','=','1')->sum('price_service');
            if($sba_1 && $sba_2 != 0){
                    $price_sba_1 = ($sba_1/$sba_1)*$sba_2 + $sba_3; // đã lấy được giá sl = 1
                }else{
                    $price_sba_1 = 0;
            }
            $sba_amount_not_1 = bill::all()->where('method','ATM')->where('date_create',$today)->where('amount','!=','1')->sum('amount');
            $get_price_not_1sba = bill::where('method','ATM')->where('date_create',$today)->where('amount','!=','1')->distinct()->sum('price'); // đã lấy được giá sl !=  1
            $price_service_not_1sba = bill::all()->where('method','ATM')->where('date_create',$today)->where('amount','!=','1')->sum('price_service');
            $sum_price_sba_not_1 = $get_price_not_1sba*$sba_amount_not_1 + $price_service_not_1sba; // đã lấy được giá sl != 1
            $sum_bill_atm = $price_sba_1 + $sum_price_sba_not_1; // 1
        // Store
            $sbs_1 = $sum_today->where('method','STORE')->where('amount','=','1')->sum('amount');
            $sbs_2 = $sum_today->where('method','STORE')->where('amount','=','1')->sum('price');
            if($sbs_1 && $sbs_2 != 0){
                    $price_sbs_1 = ($sbs_1/$sbs_1)*$sbs_2; // đã lấy được giá sl = 1
                }else{
                    $price_sbs_1 = 0;
            }
            $sbs_amount_not_1 = bill::all()->where('method','STORE')->where('date_create',$today)->where('amount','!=','1')->sum('amount');
            $get_price_not_1sbs = bill::where('method','STORE')->where('date_create',$today)->where('amount','!=','1')->distinct()->sum('price'); // đã lấy được giá sl !=  1
            $sum_price_sbs_not_1 = $get_price_not_1sbs*$sbs_amount_not_1; // đã lấy được giá sl != 1
            $sum_bill_store = $price_sbs_1 + $sum_price_sbs_not_1; // 2
        // COD
            $sbc_1 = $sum_today->where('method','COD')->where('amount','=','1')->sum('amount');
            $sbc_2 = $sum_today->where('method','COD')->where('amount','=','1')->sum('price');
            $sbc_3 = $sum_today->where('method','COD')->where('amount','=','1')->sum('price_service');
            if($sbc_1 && $sbc_2 != 0){
                    $price_sbc_1 = ($sbc_1/$sbc_1)*$sbc_2 + $sbc_3; // đã lấy được giá sl = 1
                }else{
                    $price_sbc_1 = 0;
            }
            $sbc_amount_not_1 = bill::all()->where('method','COD')->where('date_create',$today)->where('amount','!=','1')->sum('amount');
            $get_price_not_1sbc = bill::where('method','COD')->where('date_create',$today)->where('amount','!=','1')->distinct()->sum('price'); // đã lấy được giá sl !=  1
            $price_service_not_1sbc = bill::all()->where('method','COD')->where('date_create',$today)->where('amount','!=','1')->sum('price_service');
            $sum_price_sbc_not_1 = $get_price_not_1sbc*$sbc_amount_not_1 + $price_service_not_1sbc; // đã lấy được giá sl != 1
            $sum_bill_cod = $price_sbc_1 + $sum_price_sbc_not_1; // 3

        $sum_bill = $sum_bill_atm+$sum_bill_store+$sum_bill_cod;
         
        //**** Dữ liệu lấy để so sánh */
        $old_day = Carbon::now('Asia/Ho_Chi_Minh')->subDays(1)->toDateString();
            $od_ = bill::all()->where('date_create',$old_day);
            // ATM
            $sba_o1 = $od_->where('method','ATM')->where('amount','=','1')->sum('amount');
            $sba_o2 = $od_->where('method','ATM')->where('amount','=','1')->sum('price');
            $sba_o3 = $od_->where('method','ATM')->where('amount','=','1')->sum('price_service');
            if($sba_o1 && $sba_o2 != 0){
                    $price_sba_o1 = ($sba_o1/$sba_o1)*$sba_o2 + $sba_o3; // đã lấy được giá sl = 1
                }else{
                    $price_sba_o1 = 0;
            }
            $sba_amount_not_o1 = bill::all()->where('method','ATM')->where('date_create',$old_day)->where('amount','!=','1')->sum('amount');
            $get_price_not_o1sba = bill::where('method','ATM')->where('date_create',$old_day)->where('amount','!=','1')->distinct()->sum('price'); // đã lấy được giá sl !=  1
            $price_service_not_o1sba = bill::all()->where('method','ATM')->where('date_create',$old_day)->where('amount','!=','1')->sum('price_service');
            $sum_price_sba_not_o1 = $get_price_not_o1sba*$sba_amount_not_o1 + $price_service_not_o1sba; // đã lấy được giá sl != 1
            $sum_bill_atm_o = $price_sba_o1 + $sum_price_sba_not_o1; // 1
            // Store
            $sbs_o1 = $od_->where('method','STORE')->where('amount','=','1')->sum('amount');
            $sbs_o2 = $od_->where('method','STORE')->where('amount','=','1')->sum('price');
            if($sbs_o1 && $sbs_o2 != 0){
                    $price_sbs_o1 = ($sbs_o1/$sbs_o1)*$sbs_o2; // đã lấy được giá sl = 1
                }else{
                    $price_sbs_o1 = 0;
            }
            $sbs_amount_not_o1 = bill::all()->where('method','STORE')->where('date_create',$old_day)->where('amount','!=','1')->sum('amount');
            $get_price_not_o1sbs = bill::where('method','STORE')->where('date_create',$old_day)->where('amount','!=','1')->distinct()->sum('price'); // đã lấy được giá sl !=  1
            $sum_price_sbs_not_o1 = $get_price_not_o1sbs*$sbs_amount_not_o1; // đã lấy được giá sl != 1
            $sum_bill_store_o = $price_sbs_o1 + $sum_price_sbs_not_o1; // 2
            // COD
            $sbc_o1 = $od_->where('method','COD')->where('amount','=','1')->sum('amount');
            $sbc_o2 = $od_->where('method','COD')->where('amount','=','1')->sum('price');
            $sbc_o3 = $od_->where('method','COD')->where('amount','=','1')->sum('price_service');
            if($sbc_o1 && $sbc_o2 != 0){
                    $price_sbc_o1 = ($sbc_o1/$sbc_o1)*$sbc_o2 + $sbc_o3; // đã lấy được giá sl = 1
                }else{
                    $price_sbc_o1 = 0;
            }
            $sbc_amount_not_o1 = bill::all()->where('method','COD')->where('date_create',$old_day)->where('amount','!=','1')->sum('amount');
            $get_price_not_o1sbc = bill::where('method','COD')->where('date_create',$old_day)->where('amount','!=','1')->distinct()->sum('price'); // đã lấy được giá sl !=  1
            $price_service_not_o1sbc = bill::all()->where('method','COD')->where('date_create',$old_day)->where('amount','!=','1')->sum('price_service');
            $sum_price_sbc_not_o1 = $get_price_not_o1sbc*$sbc_amount_not_o1 + $price_service_not_o1sbc; // đã lấy được giá sl != 1
            $sum_bill_cod_o = $price_sbc_o1 + $sum_price_sbc_not_o1; // 3   

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
            // $gy_ = $gy-3;
            // for($y = $gy_; $y <= $gy; $y++){
            //     // ATM-
            //     $atm1 = bill::all()->where('method','ATM')->where('year_create',$y)->where('amount','1')->sum('amount');
            //     $atm2 = bill::all()->where('method','ATM')->where('year_create',$y)->where('amount','1')->sum('price');
            //     $atm3 = bill::all()->where('method','ATM')->where('year_create',$y)->where('amount','1')->sum('price_service');
            //     if($atm1 && $atm2 != 0){$price_atm1 = ($atm1/$atm1)*$atm2 + $atm3;}else{$price_atm1 = 0;}
            //     $amount_not_atm1 = bill::all()->where('method','ATM')->where('year_create',$y)->where('amount','!=','1')->sum('amount');
            //     $price_not_atm1 = bill::where('method','ATM')->where('year_create',$y)->where('amount','!=','1')->distinct()->sum('price');
            //     $price_service_not_atm1 = bill::all()->where('method','ATM')->where('year_create',$y)->where('amount','!=','1')->sum('price_service');           
            //     $sum_price_not_atm1 = $price_not_atm1 * $amount_not_atm1 + $price_service_not_atm1;
            //     $sum_bill_atms = $price_atm1 + $sum_price_not_atm1;
            //     // Store
            //     $store1 = bill::all()->where('method','STORE')->where('year_create',$y)->where('amount','1')->sum('amount');
            //     $store2 = bill::all()->where('method','STORE')->where('year_create',$y)->where('amount','1')->sum('price');
            //     if($store1 && $store2 != 0){$price_store1 = ($store1/$store1)*$store2;}else{$price_store1 = 0;}
            //     $amount_not_store1 = bill::all()->where('method','STORE')->where('year_create',$y)->where('amount','!=',1)->sum('amount');
            //     $price_not_store1 = bill::where('method','STORE')->where('year_create',$y)->where('amount','!=',1)->distinct()->sum('price');
            //     $sum_price_not_store1 = $price_not_store1*$amount_not_store1;
            //     $sum_bill_store_ys = $price_store1 + $sum_price_not_store1;
            //     // COD
            //     $cod1 = bill::all()->where('method','COD')->where('year_create',$y)->where('amount','1')->sum('amount');
            //     $cod2 = bill::all()->where('method','COD')->where('year_create',$y)->where('amount','1')->sum('price');
            //     $cod3 = bill::all()->where('method','COD')->where('year_create',$y)->where('amount','1')->sum('price_service');
            //     if($cod1 && $cod2 != 0){$price_cod1 = ($cod1/$cod1)*$cod2 + $cod3;}else{$price_cod1 = 0;}
            //     $amount_not_cod1 = bill::all()->where('method','COD')->where('year_create',$y)->where('amount','!=','1')->sum('amount');
            //     $price_not_cod1 = bill::where('method','COD')->where('year_create',$y)->where('amount','!=','1')->distinct()->sum('price');
            //     $price_service_not_cod1 = bill::all()->where('method','COD')->where('year_create',$y)->where('amount','!=','1')->sum('price_service');
            //     $sum_price_not_cod1 = $price_not_cod1*$amount_not_cod1 + $price_service_not_cod1;
            //     $sum_bill_cod_ys = $price_cod1 + $sum_price_not_cod1; // 3

                
            //     $charts = "['".$y."', ".$sum_bill_atms.", ".$sum_bill_store_ys.", ".$sum_bill_cod_ys."],";
            // }

            // ATM-
                // 0
                    $atm0_1 = bill::all()->where('method','ATM')->where('year_create',$gy)->where('amount','1')->sum('amount');
                    $atm0_2 = bill::all()->where('method','ATM')->where('year_create',$gy)->where('amount','1')->sum('price');
                    $atm0_3 = bill::all()->where('method','ATM')->where('year_create',$gy)->where('amount','1')->sum('price_service');
                    if($atm0_1 && $atm0_2 != 0){$price_atm0_1 = ($atm0_1/$atm0_1)*$atm0_2 + $atm0_3;}else{$price_atm0_1 = 0;}
                    $amount_not_atm0_1 = bill::all()->where('method','ATM')->where('year_create',$gy)->where('amount','!=','1')->sum('amount');
                    $price_not_atm0_1 = bill::where('method','ATM')->where('year_create',$gy)->where('amount','!=','1')->distinct()->sum('price');
                    $price_service_not_atm0_1 = bill::all()->where('method','ATM')->where('year_create',$gy)->where('amount','!=','1')->sum('price_service');           
                    $sum_price_not_atm0_1 = $price_not_atm0_1 * $amount_not_atm0_1 + $price_service_not_atm0_1;
                    $sum_bill_atms_0 = $price_atm0_1 + $sum_price_not_atm0_1;
                // 1
                    $atm1_1 = bill::all()->where('method','ATM')->where('year_create',$gy1)->where('amount','1')->sum('amount');
                    $atm1_2 = bill::all()->where('method','ATM')->where('year_create',$gy1)->where('amount','1')->sum('price');
                    $atm1_3 = bill::all()->where('method','ATM')->where('year_create',$gy1)->where('amount','1')->sum('price_service');
                    if($atm1_1 && $atm1_2 != 0){$price_atm1_1 = ($atm1_1/$atm1_1)*$atm1_2 + $atm1_3;}else{$price_atm1_1 = 0;}
                    $amount_not_atm1_1 = bill::all()->where('method','ATM')->where('year_create',$gy1)->where('amount','!=','1')->sum('amount');
                    $price_not_atm1_1 = bill::where('method','ATM')->where('year_create',$gy1)->where('amount','!=','1')->distinct()->sum('price');
                    $price_service_not_atm1_1 = bill::all()->where('method','ATM')->where('year_create',$gy1)->where('amount','!=','1')->sum('price_service');           
                    $sum_price_not_atm1_1 = $price_not_atm1_1 * $amount_not_atm1_1 + $price_service_not_atm1_1;
                    $sum_bill_atms_1 = $price_atm1_1 + $sum_price_not_atm1_1;
                // 2
                    $atm2_1 = bill::all()->where('method','ATM')->where('year_create',$gy2)->where('amount','1')->sum('amount');
                    $atm2_2 = bill::all()->where('method','ATM')->where('year_create',$gy2)->where('amount','1')->sum('price');
                    $atm2_3 = bill::all()->where('method','ATM')->where('year_create',$gy2)->where('amount','1')->sum('price_service');
                    if($atm2_1 && $atm2_2 != 0){$price_atm2_1 = ($atm2_1/$atm2_1)*$atm2_2 + $atm2_3;}else{$price_atm2_1 = 0;}
                    $amount_not_atm2_1 = bill::all()->where('method','ATM')->where('year_create',$gy2)->where('amount','!=','1')->sum('amount');
                    $price_not_atm2_1 = bill::where('method','ATM')->where('year_create',$gy2)->where('amount','!=','1')->distinct()->sum('price');
                    $price_service_not_atm2_1 = bill::all()->where('method','ATM')->where('year_create',$gy2)->where('amount','!=','1')->sum('price_service');           
                    $sum_price_not_atm2_1 = $price_not_atm2_1 * $amount_not_atm2_1 + $price_service_not_atm2_1;
                    $sum_bill_atms_2 = $price_atm2_1 + $sum_price_not_atm2_1;
            // Store
                //0
                    $store0_1 = bill::all()->where('method','STORE')->where('year_create',$gy)->where('amount','1')->sum('amount');
                    $store0_2 = bill::all()->where('method','STORE')->where('year_create',$gy)->where('amount','1')->sum('price');
                    if($store0_1 && $store0_2 != 0){$price_store0_1 = ($store0_1/$store0_1)*$store0_2;}else{$price_store0_1 = 0;}
                    $amount_not_store0_1 = bill::all()->where('method','STORE')->where('year_create',$gy)->where('amount','!=',1)->sum('amount');
                    $price_not_store0_1 = bill::where('method','STORE')->where('year_create',$gy)->where('amount','!=',1)->distinct()->sum('price');
                    $sum_price_not_store0_1 = $price_not_store0_1*$amount_not_store0_1;
                    $sum_bill_store_ys_0 = $price_store0_1 + $sum_price_not_store0_1;
                //1
                    $store1_1 = bill::all()->where('method','STORE')->where('year_create',$gy1)->where('amount','1')->sum('amount');
                    $store1_2 = bill::all()->where('method','STORE')->where('year_create',$gy1)->where('amount','1')->sum('price');
                    if($store1_1 && $store1_2 != 0){$price_store1_1 = ($store1_1/$store1_1)*$store1_2;}else{$price_store1_1 = 0;}
                    $amount_not_store1_1 = bill::all()->where('method','STORE')->where('year_create',$gy1)->where('amount','!=',1)->sum('amount');
                    $price_not_store1_1 = bill::where('method','STORE')->where('year_create',$gy1)->where('amount','!=',1)->distinct()->sum('price');
                    $sum_price_not_store1_1 = $price_not_store1_1*$amount_not_store1_1;
                    $sum_bill_store_ys_1 = $price_store1_1 + $sum_price_not_store1_1;
                //2
                    $store2_1 = bill::all()->where('method','STORE')->where('year_create',$gy2)->where('amount','1')->sum('amount');
                    $store2_2 = bill::all()->where('method','STORE')->where('year_create',$gy2)->where('amount','1')->sum('price');
                    if($store2_1 && $store2_2 != 0){$price_store2_1 = ($store2_1/$store2_1)*$store2_2;}else{$price_store2_1 = 0;}
                    $amount_not_store2_1 = bill::all()->where('method','STORE')->where('year_create',$gy2)->where('amount','!=',1)->sum('amount');
                    $price_not_store2_1 = bill::where('method','STORE')->where('year_create',$gy2)->where('amount','!=',1)->distinct()->sum('price');
                    $sum_price_not_store2_1 = $price_not_store2_1*$amount_not_store2_1;
                    $sum_bill_store_ys_2 = $price_store2_1 + $sum_price_not_store2_1;
            // COD
                //0
                    $cod0_1 = bill::all()->where('method','COD')->where('year_create',$gy)->where('amount','1')->sum('amount');
                    $cod0_2 = bill::all()->where('method','COD')->where('year_create',$gy)->where('amount','1')->sum('price');
                    $cod0_3 = bill::all()->where('method','COD')->where('year_create',$gy)->where('amount','1')->sum('price_service');
                    if($cod0_1 && $cod0_2 != 0){$price_cod0_1 = ($cod0_1/$cod0_1)*$cod0_2 + $cod0_3;}else{$price_cod0_1 = 0;}
                    $amount_not_cod0_1 = bill::all()->where('method','COD')->where('year_create',$gy)->where('amount','!=','1')->sum('amount');
                    $price_not_cod0_1 = bill::where('method','COD')->where('year_create',$gy)->where('amount','!=','1')->distinct()->sum('price');
                    $price_service_not_cod0_1 = bill::all()->where('method','COD')->where('year_create',$gy)->where('amount','!=','1')->sum('price_service');
                    $sum_price_not_cod0_1 = $price_not_cod0_1*$amount_not_cod0_1 + $price_service_not_cod0_1;
                    $sum_bill_cod_ys_0 = $price_cod0_1 + $sum_price_not_cod0_1; // 3
                //1
                    $cod1_1 = bill::all()->where('method','COD')->where('year_create',$gy1)->where('amount','1')->sum('amount');
                    $cod1_2 = bill::all()->where('method','COD')->where('year_create',$gy1)->where('amount','1')->sum('price');
                    $cod1_3 = bill::all()->where('method','COD')->where('year_create',$gy1)->where('amount','1')->sum('price_service');
                    if($cod1_1 && $cod1_2 != 0){$price_cod1_1 = ($cod1_1/$cod1_1)*$cod1_2 + $cod1_3;}else{$price_cod1_1 = 0;}
                    $amount_not_cod1_1 = bill::all()->where('method','COD')->where('year_create',$gy1)->where('amount','!=','1')->sum('amount');
                    $price_not_cod1_1 = bill::where('method','COD')->where('year_create',$gy1)->where('amount','!=','1')->distinct()->sum('price');
                    $price_service_not_cod1_1 = bill::all()->where('method','COD')->where('year_create',$gy1)->where('amount','!=','1')->sum('price_service');
                    $sum_price_not_cod1_1 = $price_not_cod1_1*$amount_not_cod1_1 + $price_service_not_cod1_1;
                    $sum_bill_cod_ys_1 = $price_cod1_1 + $sum_price_not_cod1_1; // 3
                //2
                    $cod2_1 = bill::all()->where('method','COD')->where('year_create',$gy2)->where('amount','1')->sum('amount');
                    $cod2_2 = bill::all()->where('method','COD')->where('year_create',$gy2)->where('amount','1')->sum('price');
                    $cod2_3 = bill::all()->where('method','COD')->where('year_create',$gy2)->where('amount','1')->sum('price_service');
                    if($cod2_1 && $cod2_2 != 0){$price_cod2_1 = ($cod2_1/$cod2_1)*$cod2_2 + $cod2_3;}else{$price_cod2_1 = 0;}
                    $amount_not_cod2_1 = bill::all()->where('method','COD')->where('year_create',$gy2)->where('amount','!=','1')->sum('amount');
                    $price_not_cod2_1 = bill::where('method','COD')->where('year_create',$gy2)->where('amount','!=','1')->distinct()->sum('price');
                    $price_service_not_cod2_1 = bill::all()->where('method','COD')->where('year_create',$gy2)->where('amount','!=','1')->sum('price_service');
                    $sum_price_not_cod2_1 = $price_not_cod2_1*$amount_not_cod2_1 + $price_service_not_cod2_1;
                    $sum_bill_cod_ys_2 = $price_cod2_1 + $sum_price_not_cod2_1; // 3

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
        
        $get_pr_famous = product_famous::where('month_c',$month_famous)
                        ->where('year_c',$year_famous)
                        ->orderbyDESC('amount_bill')
                        ->take(5)->get();
        //*** top usser */
        $get_user_ftop1 = user_famous::where('month_c',$month_famous)
                        ->where('year_c',$year_famous)
                        ->orderbyDESC('amount_user')
                        ->take(1)->get();
        foreach($get_user_ftop1 as $get_uftop1){
            $get_list_user_ftop1 = user_famous::where('month_c',$month_famous)
                        ->where('year_c',$year_famous)
                        ->where('user_id','!=',$get_uftop1->user_id)
                        ->orderbyDESC('amount_user')
                        ->take(4)
                        ->get();
        }
        $get_user_price_ftop1 = user_famous::where('month_c',$month_famous)
                        ->where('year_c',$year_famous)
                        ->orderbyDESC('total')
                        ->take(1)->get();
        foreach($get_user_price_ftop1 as $get_price_uftop1){
            $get_list_user_price_ftop1 = user_famous::where('month_c',$month_famous)
                        ->where('year_c',$year_famous)
                        ->where('user_id','!=',$get_price_uftop1->user_id)
                        ->orderbyDESC('total')
                        ->take(4)
                        ->get();
        }
        return view('dashboards.index-dashboard', compact(
            'sum_bill','total_expense','sum_bill_atm','sum_bill_store','sum_bill_cod','rate_sba',
            'rate_sbs','rate_sbc','sum_bill_y','charts_0','charts_1','charts_2','char_ck0','char_ck1','char_ck2',
            'get_pr_famous','get_user_ftop1','get_user_price_ftop1','get_list_user_ftop1','get_list_user_price_ftop1'
        ));
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
// check chưa đăng nhập k vào được giỏ hàng
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