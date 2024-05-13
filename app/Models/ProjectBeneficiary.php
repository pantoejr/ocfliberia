<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectBeneficiary extends Model
{
    use HasFactory;
    protected $fillable = [
        'visit_id',
        'beneficiary_id',
        'distribution_id',
    ];

    public function visit(){
        return $this->belongsTo(Visit::class);
    }

    public function beneficiary(){
        return $this->belongsTo(Beneficiary::class);
    }

    public function distribution(){
        return $this->belongsTo(Distribution::class);
    }
}
