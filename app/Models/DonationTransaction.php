<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DonationTransaction extends Model
{
    use HasUuids, HasFactory, SoftDeletes;

    protected $fillable = [
        'donation_code',
        'donation_category_id',
        'source',
        'donation_name',
        'amount',
        'unique_code',
        'total_amount',
        'payment_method',
        'status',
        'reference_type',
        'reference_id',
        'verified_by',
        'verified_at',
    ];

    public function donation_category()
    {
        return $this->belongsTo(DonationCategory::class, 'donation_category_id');
    }

    public function verified_by()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function zakat_fitrah()
    {
        return $this->belongsTo(ZakatFitrah::class, 'reference_id');
    }

    public function itikaf_registration()
    {
        return $this->belongsTo(ItikafRegistration::class, 'reference_id');
    }
}
