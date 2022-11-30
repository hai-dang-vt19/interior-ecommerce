<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $fillable = [
        'id',
        'id_product',
        'name_product',
        'type_product',
        'amount',
        'color',
        'color2',
        'color3',
        'price',
        'images',
        'images2',
        'descriptions',
        'metarial',
        'supplier',
        'status',
        'date',  
        'size'  
    ];
    public $timestamps = false;
}
