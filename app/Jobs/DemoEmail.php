<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderShipped;
use App\Mail\SenDiscount;
use App\Models\User;

class DemoEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    protected $email;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $email)
    {
        $this->data = $data;
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $check = $this->data['check'];
        if($check == "contact"){
            Mail::to($this->email)->send(new OrderShipped($this->data));
        }elseif($check == "discount"){
            foreach($this->email as $us){
                Mail::to($us->email)->send(new SenDiscount($this->data));
            }
        }else{
            return back();
        }
    }
}
