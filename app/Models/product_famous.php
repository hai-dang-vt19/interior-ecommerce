<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_famous extends Model
{
    use HasFactory;
    protected $table = 'product_famous';
    protected $fillable = [
        'id',
        'id_product',
        'amount_bill',
        'day_c',
        'month_c',
        'year_c'
    ];
    public $timestamps = false;  
}
