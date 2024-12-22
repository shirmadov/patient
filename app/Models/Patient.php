<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'birthdate',
        'age',
        'age_type',
        ];


    protected function casts(): array
    {
        return [
            'birthdate' => 'datetime:Y-m-d',
        ];
    }

}
