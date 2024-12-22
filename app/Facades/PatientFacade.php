<?php

namespace App\Facades;

use App\Models\Patient;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Patient create(array $fields)
 * @method static Patient list()
 */
class PatientFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'PatientFacade';
    }
}
