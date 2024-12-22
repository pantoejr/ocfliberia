<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Graduate extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullname',
        'school_type_id',
        'school_graduated',
        'class_graduated',
        'date_graduated',
        'created_by',
    ];

    public function schoolType()
    {
        return $this->belongsTo(SchoolType::class);
    }
}
