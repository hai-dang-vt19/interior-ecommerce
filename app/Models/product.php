<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_product',
        'name_product',
        'type_product',
        'amount',
        'color',
        'price',
        'images',
        'descriptions',
        'metarial',
        'supplier',
        'status',      
    ];
}
