<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agreement extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'client_address',
        'client_phone',
        'client_email',
        'project_name',
        'project_type',
        'project_start_date',
        'project_delivery_date',
        'quotation_confirmation',
        'total_amount',
        'advance_amount',
        'payment_method',
        'remaining_project_amount',
        'documents',
        'cash_transaction_name',
        'cash_transaction_to',
        'bank_name',
        'account_number',
        'bank_transaction_id',
        'mobile_banking',
        'mobile_banking_id',
    ];

    protected $casts = [
        'documents' => 'array',
        'total_amount' => 'decimal:2',
        'advance_amount' => 'decimal:2',
        'remaining_project_amount' => 'decimal:2',
    ];
}
