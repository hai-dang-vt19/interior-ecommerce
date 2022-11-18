<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_product',
        'name_product',
        'type_product',
        'amount_product',
        'color_product',
        'status_product',
        'name_discount',
        'price_product',
        'image_product',
        'total',
    ];
}
