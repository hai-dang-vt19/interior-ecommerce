<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class discount extends Model
{
    use HasFactory;
    protected $table = 'discount';
    protected $fillable = [
        'id',
        'name_discount',
        'price',
        'status_discount'       
    ];
    public $timestamps = false;
}
