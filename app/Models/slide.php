<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class slide extends Model
{
    use HasFactory;
    protected $table = 'slide';
    protected $fillable = [
        'id',
        'id_product',
        'name_product',
        'type_product',
        'descriptions',
        'price',
        'sales',
        'images',
        'position',
             
    ];
    public $timestamps = false;
}
