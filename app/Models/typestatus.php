<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class typestatus extends Model
{
    use HasFactory;
    protected $table = 'typestatus';
    protected $fillable = [
        'id',
        'nametype'       
    ];
    public $timestamps = false;
}
