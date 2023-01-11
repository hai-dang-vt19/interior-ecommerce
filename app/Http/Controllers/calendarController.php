<?php

namespace App\Http\Controllers;

use App\Models\calendar;
use App\Models\expense;
use App\Models\history;
use App\Models\luong;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class calendarController extends Controller
{
    public function add_calender(Request $request)
    {
        $t2 = $request->t2;
        $t3 = $request->t3;
        $t4 = $request->t4;
        $t5 = $request->t5;
        $t6 = $request->t6;
        $t7 = $request->t7;
        $cn = $request->cn;
    
        if($t2 == 'c1'){ $time2 = '7';} if($t2 == 'c2'){ $time2 = '7';} if($t2 == 'Fulltime'){ $time2 = '14';} if($t2 == ''){ $time2 = '0';}
        if($t3 == 'c1'){ $time3 = '7';} if($t3 == 'c2'){ $time3 = '7';} if($t3 == 'Fulltime'){ $time3 = '14';} if($t3 == ''){ $time3 = '0';}
        if($t4 == 'c1'){ $time4 = '7';} if($t4 == 'c2'){ $time4 = '7';} if($t4 == 'Fulltime'){ $time4 = '14';} if($t4 == ''){ $time4 = '0';}
        if($t5 == 'c1'){ $time5 = '7';} if($t5 == 'c2'){ $time5 = '7';} if($t5 == 'Fulltime'){ $time5 = '14';} if($t5 == ''){ $time5 = '0';}
        if($t6 == 'c1'){ $time6 = '7';} if($t6 == 'c2'){ $time6 = '7';} if($t6 == 'Fulltime'){ $time6 = '14';} if($t6 == ''){ $time6 = '0';}
        if($t7 == 'c1'){ $time7 = '7';} if($t7 == 'c2'){ $time7 = '7';} if($t7 == 'Fulltime'){ $time7 = '14';} if($t7 == ''){ $time7 = '0';}
        if($cn == 'c1'){ $timeCN = '7';} if($cn == 'c2'){ $timeCN = '7';} if($cn == 'Fulltime'){ $timeCN = '14';} if($cn == ''){ $timeCN = '0';}

        $check_max_time = $time2+$time3+$time4+$time5+$time6+$time7+$timeCN;
        if($check_max_time > 63){
            session()->flash('check_max_time', 'Quá số giờ trong tuần: '.$check_max_time.'h');
            return redirect()->route('calendar');
        }

        $check = calendar::where('idu',Auth::user()->id)->get('idu');
        $str = strlen($check);
        if($str == 11){
            $subtr = substr($check,8,1);
            }elseif($str == 12){
                $subtr = substr($check,8,2);
            }elseif($str == 13){
                $subtr = substr($check,8,3);
            }elseif($str == 14){
                $subtr = substr($check,8,4);
            }else{
                $subtr = substr($check,8,5);
        }

        if($subtr == Auth::user()->id){           
            session()->flash('calendar_er', 'Bạn đã đăng ký lịch cho tuần này');
        }else{
            $timework = [$time2,$time3,$time4,$time5,$time6,$time7,$timeCN];
            $sumTime = array_sum($timework);
            calendar::updateOrCreate([
                'idu'=>Auth::user()->id
            ],[
                'id_user'=>Auth::user()->user_id,
                'user'=>Auth::user()->name,       
                't2'=>$request->t2, 't3'=>$request->t3, 't4'=>$request->t4, 't5'=>$request->t5, 't6'=>$request->t6, 't7'=>$request->t7, 'cn'=>$request->cn,
                's2'=>$time2, 's3'=>$time3, 's4'=>$time4, 's5'=>$time5, 's6'=>$time6, 's7'=>$time7, 'scn'=>$timeCN,
                'timework'=>$sumTime
            ]);

            $salary = luong::where('user_id', Auth::user()->user_id)->get();
            if(Auth::user()->name_roles == 'manager'){
                $luong_salary = '35000';
                }else{
                $luong_salary = '23000';
            }
            if($salary != '[]'){
                foreach($salary as $total){
                    $time_luong = $total->timework+$sumTime; // đã có tổng số h mới và cũ
                    $t_salary = $time_luong*$total->salary; // số tiền nhận
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
                $t_salary = $sumTime*$luong_salary;
                luong::updateOrCreate([
                    'user_id'=>Auth::user()->user_id,
                ],[
                    'user_id'=>Auth::user()->user_id,
                    'user_name'=>Auth::user()->name,
                    'name_roles'=>Auth::user()->name_roles,
                    'salary'=>$luong_salary,
                    'timework'=>$sumTime,
                    'total_salary'=>$t_salary
                ]);
            }

            session()->flash('calendar_sc', Auth::user()->name);
        }
        return redirect(route('calendar'));
    }

    public function reset_calendar()
    {
        calendar::truncate()->where('id','!=',1);
        calendar::create([
            'idu'=>'1',
            'id_user'=>'IT-ADMIN',
            'user'=>'Admin Interior',
            't2'=>'Fulltime',
            't3'=>'Fulltime',
            't4'=>'Fulltime',
            't5'=>'Fulltime',
            't6'=>'Fulltime',
            't7'=>'Fulltime',
            'cn'=>'Fulltime',
            's2'=>'14',
            's3'=>'14',
            's4'=>'14',
            's5'=>'14',
            's6'=>'14',
            's7'=>'14',
            'scn'=>'14',
            'timework'=>'0'
        ]);
        history::create([
            'name_his'=>'Reset',
            'user_his'=>Auth::user()->email.'-'.Auth::user()->name_roles,
            'description_his'=>'RESET lịch làm việc'
        ]);
        session()->flash('calendar_rs', 'Làm mới thành công');
        return redirect()->route('calendar');
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
