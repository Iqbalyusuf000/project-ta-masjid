<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DonationSetting extends Model
{
    use HasUuids, HasFactory, SoftDeletes;

    protected $fillable = [
        'bank_name',
        'account_number',
        'account_name',
        'qris_image',
        'description',
        'rice_weight',
    ];
}
