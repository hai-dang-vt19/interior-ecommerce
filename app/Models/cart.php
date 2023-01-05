<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    use HasFactory;
    protected $table = 'cart';
    protected $fillable = [
        'id',
        'id_product',
        'id_cart_user',
        'name_product',
        'type_product',
        'amount_product',
        'color_product',
        'status_product',
        'price_product',
        'image_product',
        'datecreate',
        'total',
        'sales',
        'total_sales'
    ];
    public $timestamps = false;
}
