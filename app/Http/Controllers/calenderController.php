<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\calender;
use App\Models\expense;
use App\Models\history;
use App\Models\luong;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class calenderController extends Controller
{
    public function new_calender()
    {
        $cld = calender::all()->where('idu','!=','1');
            $count = count($cld);
            if ($cld == '[]') {
                $calender = calender::all();
            } else {
                $calender = $cld;
            }
            return view('dashboards.new-calender', compact('count','calender'));
    }
    public function post_calender(Request $request)
    {
        $timeNow = Carbon::now('Asia/Ho_Chi_Minh');
        // $timeNow = Carbon::now('Asia/Ho_Chi_Minh')->subDay(26);
        // $timeNow = Carbon::now('Asia/Ho_Chi_Minh')->subDay(12);
        // $timeNow = Carbon::now('Asia/Ho_Chi_Minh')->subDay(5);
        // $timeNow = Carbon::now('Asia/Ho_Chi_Minh')->addDay(3);
        $idu = Auth::user()->id;
        $id_user = Auth::user()->user_id;
        $user  = Auth::user()->name;     

        $n1 = $request->n1;     $n2 = $request->n2;     $n3 = $request->n3;
        $n4 = $request->n4;     $n5 = $request->n5;     $n6 = $request->n6;
        $n7 = $request->n7;     $n8 = $request->n8;     $n9 = $request->n9;
        $n10 = $request->n10;   $n11 = $request->n11;  $n12 = $request->n12;
        $n13 = $request->n13;   $n14 = $request->n14;  $n15 = $request->n15;
        $n16 = $request->n16;   $n17 = $request->n17;  $n18 = $request->n18;  
        $n19 = $request->n19;
        $n20 = $request->n20;   $n21 = $request->n21;  $n22 = $request->n22;
        $n23 = $request->n23;   $n24 = $request->n24;  $n25 = $request->n25;
        $n26 = $request->n26;   $n27 = $request->n27;  $n28 = $request->n28;
        $n29 = $request->n29;   $n30 = $request->n30;  $n31 = $request->n31;
        
        if($n1 == 'c1'){$dn1 = 7;} elseif($n1 == 'c2'){$dn1 = 7;} elseif ($n1 == 'Fulltime'){$dn1 = 14;} else {$dn1 = 0;}
        if($n2 == 'c1'){$dn2 = 7;} elseif($n2 == 'c2'){$dn2 = 7;} elseif ($n2 == 'Fulltime'){$dn2 = 14;} else {$dn2 = 0;}
        if($n3 == 'c1'){$dn3 = 7;} elseif($n3 == 'c2'){$dn3 = 7;} elseif ($n3 == 'Fulltime'){$dn3 = 14;} else {$dn3 = 0;}
        if($n4 == 'c1'){$dn4 = 7;} elseif($n4 == 'c2'){$dn4 = 7;} elseif ($n4 == 'Fulltime'){$dn4 = 14;} else {$dn4 = 0;}
        if($n5 == 'c1'){$dn5 = 7;} elseif($n5 == 'c2'){$dn5 = 7;} elseif ($n5 == 'Fulltime'){$dn5 = 14;} else {$dn5 = 0;}
        if($n6 == 'c1'){$dn6 = 7;} elseif($n6 == 'c2'){$dn6 = 7;} elseif ($n6 == 'Fulltime'){$dn6 = 14;} else {$dn6 = 0;}
        if($n7 == 'c1'){$dn7 = 7;} elseif($n7 == 'c2'){$dn7 = 7;} elseif ($n7 == 'Fulltime'){$dn7 = 14;} else {$dn7 = 0;}
        if($n8 == 'c1'){$dn8 = 7;} elseif($n8 == 'c2'){$dn8 = 7;} elseif ($n8 == 'Fulltime'){$dn8 = 14;} else {$dn8 = 0;}
        if($n9 == 'c1'){$dn9 = 7;} elseif($n9 == 'c2'){$dn9 = 7;} elseif ($n9 == 'Fulltime'){$dn9 = 14;} else {$dn9 = 0;}
        if($n10 == 'c1'){$dn10 = 7;} elseif ($n10 == 'c2'){$dn10 = 7;} elseif ($n10 == 'Fulltime'){$dn10 = 14;} else {$dn10 = 0;}
        if($n11 == 'c1'){$dn11 = 7;} elseif ($n11 == 'c2'){$dn11 = 7;} elseif ($n11 == 'Fulltime'){$dn11 = 14;} else {$dn11 = 0;}
        if($n12 == 'c1'){$dn12 = 7;} elseif ($n12 == 'c2'){$dn12 = 7;} elseif ($n12 == 'Fulltime'){$dn12 = 14;} else {$dn12 = 0;}
        if($n13 == 'c1'){$dn13 = 7;} elseif ($n13 == 'c2'){$dn13 = 7;} elseif ($n13 == 'Fulltime'){$dn13 = 14;} else {$dn13 = 0;}
        if($n14 == 'c1'){$dn14 = 7;} elseif ($n14 == 'c2'){$dn14 = 7;} elseif ($n14 == 'Fulltime'){$dn14 = 14;} else {$dn14 = 0;}
        if($n15 == 'c1'){$dn15 = 7;} elseif ($n15 == 'c2'){$dn15 = 7;} elseif ($n15 == 'Fulltime'){$dn15 = 14;} else {$dn15 = 0;}
        if($n16 == 'c1'){$dn16 = 7;} elseif ($n16 == 'c2'){$dn16 = 7;} elseif ($n16 == 'Fulltime'){$dn16 = 14;} else {$dn16 = 0;}
        if($n17 == 'c1'){$dn17 = 7;} elseif ($n17 == 'c2'){$dn17 = 7;} elseif ($n17 == 'Fulltime'){$dn17 = 14;} else {$dn17 = 0;}
        if($n18 == 'c1'){$dn18 = 7;} elseif ($n18 == 'c2'){$dn18 = 7;} elseif ($n18 == 'Fulltime'){$dn18 = 14;} else {$dn18 = 0;}
        if($n19 == 'c1'){$dn19 = 7;} elseif ($n19 == 'c2'){$dn19 = 7;} elseif ($n19 == 'Fulltime'){$dn19 = 14;} else {$dn19 = 0;}
        if($n20 == 'c1'){$dn20 = 7;} elseif ($n20 == 'c2'){$dn20 = 7;} elseif ($n20 == 'Fulltime'){$dn20 = 14;} else {$dn20 = 0;}
        if($n21 == 'c1'){$dn21 = 7;} elseif ($n21 == 'c2'){$dn21 = 7;} elseif ($n21 == 'Fulltime'){$dn21 = 14;} else {$dn21 = 0;}
        if($n22 == 'c1'){$dn22 = 7;} elseif ($n22 == 'c2'){$dn22 = 7;} elseif ($n22 == 'Fulltime'){$dn22 = 14;} else {$dn22 = 0;}
        if($n23 == 'c1'){$dn23 = 7;} elseif ($n23 == 'c2'){$dn23 = 7;} elseif ($n23 == 'Fulltime'){$dn23 = 14;} else {$dn23 = 0;}
        if($n24 == 'c1'){$dn24 = 7;} elseif ($n24 == 'c2'){$dn24 = 7;} elseif ($n24 == 'Fulltime'){$dn24 = 14;} else {$dn24 = 0;}
        if($n25 == 'c1'){$dn25 = 7;} elseif ($n25 == 'c2'){$dn25 = 7;} elseif ($n25 == 'Fulltime'){$dn25 = 14;} else {$dn25 = 0;}
        if($n26 == 'c1'){$dn26 = 7;} elseif ($n26 == 'c2'){$dn26 = 7;} elseif ($n26 == 'Fulltime'){$dn26 = 14;} else {$dn26 = 0;}
        if($n27 == 'c1'){$dn27 = 7;} elseif ($n27 == 'c2'){$dn27 = 7;} elseif ($n27 == 'Fulltime'){$dn27 = 14;} else {$dn27 = 0;}
        if($n28 == 'c1'){$dn28 = 7;} elseif ($n28 == 'c2'){$dn28 = 7;} elseif ($n28 == 'Fulltime'){$dn28 = 14;} else {$dn28 = 0;}
        if($n29 == 'c1'){$dn29 = 7;} elseif ($n29 == 'c2'){$dn29 = 7;} elseif ($n29 == 'Fulltime'){$dn29 = 14;} else {$dn29 = 0;}
        if($n30 == 'c1'){$dn30 = 7;} elseif ($n30 == 'c2'){$dn30 = 7;} elseif ($n30 == 'Fulltime'){$dn30 = 14;} else {$dn30 = 0;}
        if($n31 == 'c1'){$dn31 = 7;} elseif ($n31 == 'c2'){$dn31 = 7;} elseif ($n31 == 'Fulltime'){$dn31 = 14;} else {$dn31 = 0;}
        // $timework = [
        //     $dn1,$dn2,$dn3,$dn4,$dn5,$dn6,$dn7,$dn8,$dn9,
        //     $dn10,$dn11,$dn12,$dn13,$dn14,$dn15,$dn16,
        //     $dn17,$dn18,$dn19,$dn20,$dn21,
        //     $dn22,$dn23,$dn24,$dn25,$dn26,
        //     $dn27,$dn28,$dn29,$dn30,$dn31
        // ];
        // $sumTime = array_sum($timework);
        // print_r($sumTime);return;

        $check = calender::where('idu',$idu);
        if($timeNow->day <= 7){
            $max_time = $dn1+$dn2+$dn3+$dn4+$dn5+$dn6+$dn7;
            if($check->get('idu') != '[]' && $check->get('t1') != '[{"t1":null}]'){
                session()->flash('calender_er', 'Bạn đã đăng ký lịch cho tuần 1');
                return redirect()->route('calender');
            }else{
                calender::updateOrCreate([
                    'idu' => $idu,
                    'id_user'=>$id_user,
                    'user'=>$user 
                ],[
                    'n1'=>$dn1,'n2'=>$dn2,'n3'=>$dn3,'n4'=>$dn4,'n5'=>$dn5,'n6'=>$dn6,'n7'=>$dn7,
                    'c1'=>$n1,'c2'=>$n2,'c3'=>$n3,'c4'=>$n4,'c5'=>$n5,'c6'=>$n6,'c7'=>$n7,
                    't1'=>'x',
                    'timework'=>$max_time + $check->sum('timework')
                ]);
            }
            
        }elseif($timeNow->day > 7 && $timeNow->day <= 14){
                $max_time = $dn8+$dn9+$dn10+$dn11+$dn12+$dn13+$dn14;
                
                if($check->get('idu') != '[]' && $check->get('t2') != '[{"t2":null}]'){
                    session()->flash('calender_er', 'Bạn đã đăng ký lịch cho tuần 2');
                    return redirect()->route('calender');
                }else{
                    calender::updateOrCreate([
                        'idu' => $idu,
                        'id_user'=>$id_user,
                        'user'=>$user 
                    ],[
                        'n8'=>$dn8,'n9'=>$dn9,'n10'=>$dn10,'n11'=>$dn11,'n12'=>$dn12,'n13'=>$dn13,'n14'=>$dn14,
                        'c8'=>$n8,'c9'=>$n9,'c10'=>$n10,'c11'=>$n11,'c12'=>$n12,'c13'=>$n13,'c14'=>$n14,
                        't2'=>'x',
                        'timework'=>$max_time + $check->sum('timework')
                    ]);
                }
        }elseif($timeNow->day > 14 && $timeNow->day <= 21){
                $max_time = $dn15+$dn16+$dn17+$dn18+$dn19+$dn20+$dn21;
                
                if($check->get('idu') != '[]' && $check->get('t3') != '[{"t3":null}]'){
                    session()->flash('calender_er', 'Bạn đã đăng ký lịch cho tuần 3');
                    return redirect()->route('calender');
                }else{
                    calender::updateOrCreate([
                        'idu' => $idu,
                        'id_user'=>$id_user,
                        'user'=>$user 
                    ],[
                        'n15'=>$dn15,'n16'=>$dn16,'n17'=>$dn17,'n18'=>$dn18,'n19'=>$dn19,'n20'=>$dn20,'n21'=>$dn21,
                        'c15'=>$n15,'c16'=>$n16,'c17'=>$n17,'c18'=>$n18,'c19'=>$n19,'c20'=>$n20,'c21'=>$n21,
                        't3'=>'x',
                        'timework'=>$max_time + $check->sum('timework')
                    ]);
                }
        }elseif($timeNow->day > 21 && $timeNow->day <= 28){
                $max_time = $dn22+$dn23+$dn24+$dn25+$dn26+$dn27+$dn28;
                
                if($check->get('idu') != '[]' && $check->get('t4') != '[{"t4":null}]'){
                    session()->flash('calender_er', 'Bạn đã đăng ký lịch cho tuần 4');
                    return redirect()->route('calender');
                }else{
                    calender::updateOrCreate([
                        'idu' => $idu,
                        'id_user'=>$id_user,
                        'user'=>$user 
                    ],[
                        'n22'=>$dn22,'n23'=>$dn23,'n24'=>$dn24,'n25'=>$dn25,'n26'=>$dn26,'n27'=>$dn27,'n28'=>$dn28,
                        'c22'=>$n22,'c23'=>$n23,'c24'=>$n24,'c25'=>$n25,'c26'=>$n26,'c27'=>$n27,'c28'=>$n28,
                        't4'=>'x',
                        'timework'=>$max_time + $check->sum('timework')
                    ]);
                }
        }else{
            $max_time = $dn29+$dn30+$dn31;

            if($check->get('idu') != '[]' && $check->get('t5') != '[{"t5":null}]'){
                session()->flash('calender_er', 'Bạn đã đăng ký lịch cho tuần 5');
                return redirect()->route('calender');
            }else{
                calender::updateOrCreate([
                    'idu' => $idu,
                    'id_user'=>$id_user,
                    'user'=>$user 
                ],[
                    'n29'=>$dn29,'n30'=>$dn30,'n31'=>$dn31,
                    'c29'=>$n29,'c30'=>$n30,'c31'=>$n31,
                    't5'=>'x',
                    'timework'=>$max_time + $check->sum('timework')
                ]);
            }
        }
        $salary = luong::where('user_id', Auth::user()->user_id)->get();
            if(Auth::user()->name_roles == 'manager'){
                $luong_salary = '35000';
            }else{
                $luong_salary = '23000';
            }
            if($salary != '[]'){
                foreach($salary as $total){
                    $time_luong = $total->timework+$max_time; // đã có tổng số h mới và cũ
                    $t_salary = $time_luong*$luong_salary; // số tiền nhận
                    luong::updateOrCreate([
                        'user_id'=>Auth::user()->user_id,
                    ],[
                        'user_id'=>Auth::user()->user_id,
                        'user_name'=>Auth::user()->name,
                        'name_roles'=>Auth::user()->name_roles,
                        'salary'=>$luong_salary,
                        'timework'=>$time_luong,
                        'total_salary'=>$t_salary
                    ]);
                }
            }else{
                $t_salary = $max_time*$luong_salary;
                // print_r($t_salary);return;
                luong::updateOrCreate([
                    'user_id'=>Auth::user()->user_id,
                ],[
                    'user_id'=>Auth::user()->user_id,
                    'user_name'=>Auth::user()->name,
                    'name_roles'=>Auth::user()->name_roles,
                    'salary'=>$luong_salary,
                    'timework'=>$max_time,
                    'total_salary'=>$t_salary
                ]);
            }
        session()->flash('calender_sc', Auth::user()->name);
        return redirect(route('calender'));
        // if($max_time > 98){
        //     session()->flash('check_max_time', 'Quá số giờ trong tuần: '.$max_time.'h');
        //     return redirect()->route('calender');
        // }
        // calender::updateOrCreate([
        //     'idu' => $idu 
        // ],[
        //     'n1'=>$dn1,'n2'=>$dn2,'n3'=>$dn3,'n4'=>$dn4,'n5'=>$dn5,'n6'=>$dn6,'n7'=>$dn7,
        //     'n8'=>$dn8,'n9'=>$dn9,'n10'=>$dn10,'n11'=>$dn11,'n12'=>$dn12,'n13'=>$dn13,'n14'=>$dn14,
        //     'n15'=>$dn15,'n16'=>$dn16,'n17'=>$dn17,'n18'=>$dn18,'n19'=>$dn19,'n20'=>$dn20,'n21'=>$dn21,
        //     'n22'=>$dn22,'n23'=>$dn23,'n24'=>$dn24,'n25'=>$dn25,'n26'=>$dn26,'n27'=>$dn27,'n28'=>$dn28,
        //     'n29'=>$dn29,'n30'=>$dn30,'n31'=>$dn31,
        //     'timework'=>$max_time + $check->sum('timework')
        // ]);
        // dd($request->all());
        
    }

    public function reset_calender()
    {
        calender::truncate()->where('idu','!=',1);
        calender::create([
            'idu'=>'1',
            'id_user'=>'IT-ADMIN',
            'user'=>'Admin Interior',
            'n1'=>'14',       
            'n2'=>'14',       
            'n3'=>'14',
            'n4'=>'14',
            'n5'=>'14',
            'n6'=>'14',
            'n7'=>'14',
            'n8'=>'14',
            'n9'=>'14',
            'n10'=>'14',
            'n11'=>'14',
            'n12'=>'14',
            'n13'=>'14',
            'n14'=>'14',
            'n15'=>'14',
            'n16'=>'14',
            'n17'=>'14',
            'n18'=>'14',
            'n19'=>'14',
            'n20'=>'14',
            'n21'=>'14',
            'n22'=>'14',
            'n23'=>'14',
            'n24'=>'14',
            'n25'=>'14',
            'n26'=>'14',
            'n27'=>'14',
            'n28'=>'14',
            'n29'=>'14',
            'n30'=>'14',
            'n31'=>'14',
            'c1'=>'Fulltime',       
            'c2'=>'Fulltime',       
            'c3'=>'Fulltime',
            'c4'=>'Fulltime',
            'c5'=>'Fulltime',
            'c6'=>'Fulltime',
            'c7'=>'Fulltime',
            'c8'=>'Fulltime',
            'c9'=>'Fulltime',
            'c10'=>'Fulltime',
            'c11'=>'Fulltime',
            'c12'=>'Fulltime',
            'c13'=>'Fulltime',
            'c14'=>'Fulltime',
            'c15'=>'Fulltime',
            'c16'=>'Fulltime',
            'c17'=>'Fulltime',
            'c18'=>'Fulltime',
            'c19'=>'Fulltime',
            'c20'=>'Fulltime',
            'c21'=>'Fulltime',
            'c22'=>'Fulltime',
            'c23'=>'Fulltime',
            'c24'=>'Fulltime',
            'c25'=>'Fulltime',
            'c26'=>'Fulltime',
            'c27'=>'Fulltime',
            'c28'=>'Fulltime',
            'c29'=>'Fulltime',
            'c30'=>'Fulltime',
            'c31'=>'Fulltime',
            'timework'=>'0',
            't1'=>'x',
            't2'=>'x',
            't3'=>'x',
            't4'=>'x',
            't5'=>'x'
        ]);
        history::create([
            'name_his'=>'Reset',
            'user_his'=>Auth::user()->email.'-'.Auth::user()->name_roles,
            'description_his'=>'RESET lịch làm việc'
        ]);
        session()->flash('calender_rs', 'Làm mới thành công');
        return redirect()->route('calender');
    }

    public function reset_salary()
    {
        // tổng lương hoặc tổng lương + expense_salary cũ
        $get_salary_fe = luong::all();
        $sum_salary = $get_salary_fe->sum('total_salary'); //có tổng lương

        $get_year = Carbon::now('Asia/Ho_Chi_Minh')->year;
        $old_expense = expense::where('years',$get_year)->get('expense_salary');
            foreach($old_expense as $item){
                $get_old_ex = $item->expense_salary;
            }
            $old = $get_old_ex;
            if($old == 0){
                if($old == 0){
                    expense::where('years',$get_year)->update(['expense_salary'=>$sum_salary]);
                }else{
                    expense::create(['years'=>$get_year,'expense_salary'=>$sum_salary]);
                }
            }else{
                $expense_salary = $sum_salary+$old;
                expense::updateOrCreate([
                    'years'=>$get_year
                ],[
                    'expense_salary'=>$expense_salary
                ]);
            }

        luong::truncate();
        session()->flash('salary_rs', 'Làm mới thành công');
        return back();
    }
}
