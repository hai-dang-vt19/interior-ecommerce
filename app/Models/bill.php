<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bill extends Model
{
    use HasFactory;
    protected $table = 'bill';
    protected $fillable = [
        'id',
        'id_bill',
        'id_product',
        'name_product',
        'amount',
        'price',
        'username',
        'email',
        'phone',
        'method',
        'date_create',
        'bank',
        'code_bank',
        'code_vnpay',
        'address',
        'total',
        'status_product_bill'
    ];
    public $timestamps = false;
}
