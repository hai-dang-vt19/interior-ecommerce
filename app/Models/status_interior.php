<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class status_interior extends Model
{
    use HasFactory;
    protected $table = 'status_interior';
    protected $fillable = [
        'id_status',
        'name_status',
        'type_status'       
    ];
    public $timestamps = false;
}
