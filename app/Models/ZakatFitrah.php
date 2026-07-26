<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ZakatFitrah extends Model
{
    use HasUuids, HasFactory, SoftDeletes;

    protected $fillable = [
        'zakat_code',
        'muzakki_name',
        'address',
        'total_people',
        'rice_total',
        'zakat_status',
        'verified_at',
    ];
    public function infaq()
    {
        return $this->hasOne(DonationTransaction::class, 'reference_id')
                    ->where('reference_type', 'zakat_fitrah');
    }
}
