<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Member extends Model
{
    use HasUuids, HasFactory;

    protected $fillable = [
        'name',
        'photo',
    ];

    public function organization()
    {
        return $this->hasMany(Organization::class);
    }

    public function getPhotoUrlAttribute()
    {
        return $this->photo
            ? Storage::url($this->photo)
            : null;
    }

    public function getInitialsAttribute()
    {
        return collect(explode(' ', $this->name))
            ->map(fn($word) => strtoupper(substr($word, 0, 1)))
            ->take(2)
            ->join('');
    }
}
