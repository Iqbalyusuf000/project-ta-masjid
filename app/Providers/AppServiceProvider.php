<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\ItikafRegistration;
use App\Observers\ItikafRegistrationObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ItikafRegistration::observe(ItikafRegistrationObserver::class);
    }
}
