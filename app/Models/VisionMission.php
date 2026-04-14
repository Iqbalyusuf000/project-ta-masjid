<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class VisionMission extends Model
{
    /** @use HasFactory<\Database\Factories\VisionMissionFactory> */
    use HasFactory, HasUuids;

    protected $fillable = [
        'visi',
        'misi',
        'created_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
