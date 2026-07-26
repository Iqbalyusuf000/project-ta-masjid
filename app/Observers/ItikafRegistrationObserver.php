<?php

namespace App\Observers;

use App\Models\ItikafRegistration;

class ItikafRegistrationObserver
{
    /**
     * Handle the ItikafRegistration "created" event.
     */
    public function created(ItikafRegistration $itikafRegistration): void
    {
        //
    }

    /**
     * Handle the ItikafRegistration "updated" event.
     */
    public function updated(ItikafRegistration $itikafRegistration): void
    {
        // Jika status diubah menjadi success (dan sebelumnya bukan success)
        if ($itikafRegistration->isDirty('status') && $itikafRegistration->status === 'success') {
            
            // Cek apakah ada infaq yang terhubung
            $infaq = $itikafRegistration->infaq;
            
            // Jika ada infaq, ubah statusnya menjadi success juga
            if ($infaq && $infaq->status !== 'success') {
                $infaq->update([
                    'status' => 'success',
                    'verified_by' => auth()->id(), // Opsional: merekam siapa yang memverifikasi (admin yang login)
                    'verified_at' => now(),
                ]);
            }
        }
    }

    /**
     * Handle the ItikafRegistration "deleted" event.
     */
    public function deleted(ItikafRegistration $itikafRegistration): void
    {
        //
    }

    /**
     * Handle the ItikafRegistration "restored" event.
     */
    public function restored(ItikafRegistration $itikafRegistration): void
    {
        //
    }

    /**
     * Handle the ItikafRegistration "force deleted" event.
     */
    public function forceDeleted(ItikafRegistration $itikafRegistration): void
    {
        //
    }
}
