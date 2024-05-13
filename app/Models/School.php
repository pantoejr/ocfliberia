<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'county_id',
        'sponsor_id',
        'total_girls',
        'created_by',
        'is_active',
        'location',
    ];

    public function sponsor(){
        return $this->belongsTo(Sponsor::class);
    }

    public function county(){
        return $this->belongsTo(CountyType::class);
    }
}
