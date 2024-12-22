<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
class PatientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        dd($this->birthdate);
        return [
            'name'=>$this->first_name.' '.$this->last_name,
            'birthdate'=> Carbon::parse($this->birthdate)->format('d.m.Y'),
            'age'=>$this->age.' '.$this->age_type,
        ];
    }
}
