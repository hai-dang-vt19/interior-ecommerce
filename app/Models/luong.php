<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class luong extends Model
{
    use HasFactory;
    protected $table = 'luong';
    protected $fillable = [
        'id',
        'user_id',
        'user_name',
        'name_roles',
        'timework',
        'salary',
        'total_salary'
    ];
    public $timestamps = false;
}
