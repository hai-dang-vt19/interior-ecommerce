<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class history extends Model
{
    use HasFactory;
    protected $table = 'history';
    protected $fillable = [
        'id',
        'name_his',
        'user_his',
        'description_his',
        'created_at'
    ];
}
