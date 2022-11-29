<?php

namespace App\Http\Controllers;

use App\Models\calendar;
use App\Models\history;
use App\Models\luong;
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
        calendar::truncate();
        history::create([
            'name_his'=>'Reset',
            'user_his'=>Auth::user()->email.'-'.Auth::user()->name_roles,
            'description_his'=>'RESET lịch làm việc'
        ]);
        session()->flash('calendar_rs', 'Làm mới thành công');
        return back();
    }
    public function reset_salary()
    {
        luong::truncate();
        session()->flash('salary_rs', 'Làm mới thành công');
        return back();
    }
}
