<?php

namespace App\Models;

use Filament\Panel\Concerns\HasFavicon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationPeriod extends Model
{
    use HasUuids, HasFactory;

    protected $fillable = [
        'name',
        'start_year',
        'end_year',
        'is_active',
    ];

    protected static function booted()
    {
        static::saving(function ($period) {

            if ($period->is_active) {

                self::where('id', '!=', $period->id)
                    ->update([
                        'is_active' => false,
                    ]);
            }
        });
    }

    public function organizations()
    {
        return $this->hasMany(Organization::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
