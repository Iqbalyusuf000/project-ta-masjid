<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpenseTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'expense_code',
        'title',
        'category',
        'amount',
        'expense_date',
        'receipt_image',
    ];

    protected $casts = [
        'expense_date' => 'date',
    ];
}
