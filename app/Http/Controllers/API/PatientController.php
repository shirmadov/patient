<?php

namespace App\Http\Controllers\API;


use App\Facades\PatientFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\PatientStoreRequest;

class PatientController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json([
            'status' => 200,
            'date' => PatientFacade::list(),
        ]);
    }

    /**
     * @param PatientStoreRequest $request
     * @return void
     */
    public function store(PatientStoreRequest $request)
    {
       PatientFacade::create($request->validated());
       return response()->json([
           'status' => 200,
           'message' => 'Patient created successfully.'
       ]);
    }

}
