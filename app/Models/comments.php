<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $fillable = [
        'id',
        'name_user',
        'id_user',
        'id_product',
        'status_comment',
        'date_create',
        'img'
    ];
    public $timestamps = false;    
}
