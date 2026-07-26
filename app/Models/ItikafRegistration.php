<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItikafRegistration extends Model
{
    use HasUuids, HasFactory, SoftDeletes;

    protected $fillable = [
        'itikaf_code',
        'name',
        'whatsapp',
        'gender',
        'days_selected',
        'status',
    ];

    protected $casts = [
        'days_selected' => 'array',
    ];

    public function infaq()
    {
        return $this->hasOne(DonationTransaction::class, 'reference_id')
                    ->where('reference_type', 'itikaf_registration');
    }
}
