<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'school_id',
        'visit_date',
        'sponsor_id',
        'description',
        'created_by',
        'is_active',
    ];

    public function school(){
        return $this->belongsTo(School::class);
    }

    public function sponsor(){
        return $this->belongsTo(Sponsor::class);
    }
}
