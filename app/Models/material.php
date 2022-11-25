<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class material extends Model
{
    use HasFactory;
    protected $table = 'material';
    protected $fillable = [
        'id',
        'name_material',
        'price',
        'supplier',
        'status_material'       
    ];
    public $timestamps = false;
}
