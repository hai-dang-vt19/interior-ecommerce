<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class status extends Model
{
    use HasFactory;
    protected $table = 'status';
    protected $fillable = [
        'id_status',
        'name_status',
        'type_status'       
    ];
    public $timestamps = false;
}
