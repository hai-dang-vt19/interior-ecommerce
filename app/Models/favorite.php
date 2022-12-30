<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class favorite extends Model
{
    use HasFactory;
    protected $table = 'favorite';
    protected $fillable = [
        'id',
        'id_user',
        'id_product',
        'name_product',
        'price',
        'img',
        'status_product'
    ];
    public $timestamps = false;  
}
