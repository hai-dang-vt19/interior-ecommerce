<?php

namespace App\Console;
use App\Console\Commands\SchedulePosts;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
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
        })->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
