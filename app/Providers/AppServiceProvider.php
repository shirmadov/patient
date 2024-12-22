<?php

namespace App\Providers;

use App\Models\Patient;
use App\Observers\PatientObserver;
use App\Services\PatientService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->resolveFacades();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Patient::observe(PatientObserver::class);
    }

    private function resolveFacades(): void
    {
        $this->app->bind('PatientFacade', PatientService::class);
    }
}
