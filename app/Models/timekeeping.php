<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class timekeeping extends Model
{
    use HasFactory;
    protected $table = 'timekeeping';
    protected $fillable = [
        'id',
        'id_user',
        'ip',       
        'address',       
        'telecom_operator',       
        'lat_lon',       
        'check_in',       
        'check_out',
        'late'      
    ];
    public $timestamps = false;
}
