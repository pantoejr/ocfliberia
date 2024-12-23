<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoicePayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'client_id',
        'creation_date',
        'payment_method_id',
        'total_amount',
        'currency_id',
        'created_by'
    ];
}
