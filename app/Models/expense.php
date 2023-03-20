<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class expense extends Model
{
    use HasFactory;
    protected $table = 'expense';
    protected $fillable = [
        'id',
        'expense_salary',
        'expense_material',
        'expense_incurred',
        'years',       
    ];
    public $timestamps = false;
}
