<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'invoice_status_id',
        'creation_date',
        'due_date',
        'fully_paid_date',
        'notes',
        'created_by'
    ];
}
