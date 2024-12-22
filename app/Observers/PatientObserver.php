<?php

namespace App\Observers;

use App\Models\Patient;
use Illuminate\Support\Facades\Cache;

class PatientObserver
{
    protected $cacheKey = 'patient_list';
    /**
     * Handle the Patient "created" event.
     */
    public function created(Patient $patient): void
    {
        $this->updateCache();
    }

    protected function updateCache(): void
    {
        Cache::put($this->cacheKey, Patient::all(),now()->addMinutes(5));
    }
}
