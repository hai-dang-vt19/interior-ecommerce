<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class typeproduct extends Model
{
    use HasFactory;
    protected $table = 'type_product';
    protected $fillable = [
        'id',
        'name_type',
        'type_status'       
    ];
    public $timestamps = false;
}
