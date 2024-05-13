<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribution extends Model
{
    use HasFactory;
    protected $fillable = [
        'visit_id',
        'distribution_date',
        'num_distributed',
        'distribution_type_id',
        'created_by',
        'is_active'
    ];

    public function visit(){
        return $this->belongsTo(Visit::class);
    }

    public function distributionType(){
        return $this->belongsTo(DistributionType::class);
    }
}
