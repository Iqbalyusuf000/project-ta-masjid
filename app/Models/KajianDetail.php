<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KajianDetail extends Model
{
    use HasUuids, HasFactory, SoftDeletes;

    protected $fillable = [
        'kajian_id',
        'ustadz_id',
        'location_id',
        'sub_title',
        'date',
        'time_type',
        'start_time',
        'time_phrase',
        'note',
        'poster',
        // 'information',
        'description',
    ];

    public function kajian()
    {
        return $this->belongsTo(Kajian::class);
    }

    public function ustadz()
    {
        return $this->belongsTo(Ustadz::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    protected static function booted()
    {
        static::saving(function ($detail) {
            if ($detail->time_type === 'phrase') {
                // Jika admin pilih Ba'da Maghrib, kita set jam internalnya ke 18:00
                // supaya SQL tetap bisa mengurutkan dan mengecek fitur expired!
                $detail->start_time = match ($detail->time_phrase) {
                    'Ba\'da Subuh'   => '05:00:00',
                    'Ba\'da Zuhur'   => '12:30:00',
                    'Ba\'da Ashar'   => '16:00:00',
                    'Ba\'da Maghrib' => '18:00:00',
                    'Ba\'da Isya'    => '19:30:00',
                    default          => '00:00:00',
                };
            } else {
                // Jika admin input jam angka (misal 09:00), isi time_phrase otomatis agar seragam
                $detail->time_phrase = \Carbon\Carbon::parse($detail->start_time)->format('H:i') . ' WIB';
            }
        });
    }
}
