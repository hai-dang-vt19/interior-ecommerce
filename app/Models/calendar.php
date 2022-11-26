<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class calendar extends Model
{
    use HasFactory;
    protected $table = 'calendar';
    protected $fillable = [
        'id',
        'id_user',
        'user',       
        't2',       
        't3',       
        't4',       
        't5',       
        't6',       
        't7',       
        'cn'       
    ];
    public $timestamps = false;
}
