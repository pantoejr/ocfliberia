<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    use HasFactory;
    protected $fillable = [
        'fullname',
        'school_id',
        'age',
        'date_of_birth',
        'location',
        'contact',
        'class',
        'image',
        'is_new',
        'created_by',
        'is_active',
    ];
}
