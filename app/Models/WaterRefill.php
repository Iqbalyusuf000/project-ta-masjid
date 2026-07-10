<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class WaterRefill extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'description',
        'price',
        'photo',
        'info',
        'is_active',
    ];
}
