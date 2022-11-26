<?php

namespace App\Http\Controllers;

use App\Models\calendar;
use App\Models\history;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class calendarController extends Controller
{
    public function add_calender(Request $request)
    {
        $check = calendar::where('id_user',$request->id_user)->get('id_user');
        $str = strlen($check);

        if($str == 15){
            $subtr = substr($check,12,1);
        }elseif($str == 16){
            $subtr = substr($check,12,2);
        }elseif($str == 17){
            $subtr = substr($check,12,3);
        }elseif($str == 18){
            $subtr = substr($check,12,4);
        }else{
            $subtr = substr($check,12,5);
        }

        if($subtr == $request->id_user){           
            session()->flash('calendar_er', 'Bạn đã đăng ký lịch cho tuần này');
        }else{
            calendar::updateOrCreate([
                'id_user'=>Auth::user()->id
            ],[
                'user'=>Auth::user()->name,       
                't2'=>$request->t2,       
                't3'=>$request->t3,       
                't4'=>$request->t4,       
                't5'=>$request->t5,       
                't6'=>$request->t6,       
                't7'=>$request->t7,       
                'cn'=>$request->cn 
            ]);
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
}
