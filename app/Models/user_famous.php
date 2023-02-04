<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_famous extends Model
{
    use HasFactory;
    protected $table = 'user_famous';
    protected $fillable = [
        'id',
        'user_id',
        'username',
        'amount_user',
        'day_c',
        'month_c',
        'year_c',
        'total'
    ];
    public $timestamps = false;  
}
