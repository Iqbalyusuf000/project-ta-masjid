<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kajian extends Model
{
    use HasUuids, HasFactory, SoftDeletes;

    protected $fillable = [
        'kajian_category_id',
        'title',
        'slug',
        'type',
    ];

    public function kajianCategory()
    {
        return $this->belongsTo(KajianCategory::class);
    }
}
