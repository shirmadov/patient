<?php

namespace App\Services;
use App\Enums\AgeTypeEnum;
use App\Http\Resources\PatientResource;
use App\Jobs\ProcessPatient;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class PatientService
{
    protected $cacheKey = 'patient_list';

    public function create(array $data)
    {
        $birthdate = Carbon::parse($data['birthdate']);

        $ageinDays = $birthdate->diffInDays();
        $age = $ageinDays < 30 ? $ageinDays : ($birthdate->diffInMonths() < 12 ? $birthdate->diffInMonths() : $birthdate->diffInYears());
        $ageType = $ageinDays < 30 ? AgeTypeEnum::DAYS : ($birthdate->diffInMonths() < 12 ? AgeTypeEnum::MONTHS : AgeTypeEnum::YEARS);

        $data['birthdate'] = Carbon::createFromFormat('d-m-Y', $data['birthdate'])->format('Y-m-d');
        $data['age'] = $age;
        $data['age_type'] = $ageType;

        $patient = Patient::create($data);

        ProcessPatient::dispatch($patient);
        return $patient;
    }

    public function list()
    {
        $cacheDuration = now()->addMinutes(30);

        return PatientResource::collection(
            Cache::remember($this->cacheKey, $cacheDuration, function () {
                return Patient::all();
            }));
    }

}
