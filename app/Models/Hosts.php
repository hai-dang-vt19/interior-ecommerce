<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hosts extends Model
{
    use HasFactory;
    protected $table = 'hosts';
    protected $fillable = [
        'id',
        'host',
        'active'
    ];
    public $timestamps = false;
}
