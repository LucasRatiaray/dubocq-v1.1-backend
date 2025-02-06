<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Employee;
use App\Http\Requests\Api\V1\StoreEmployeeRequest;
use App\Http\Requests\Api\V1\UpdateEmployeeRequest;
use App\Http\Resources\V1\EmployeeResource;
use App\Http\Resources\V1\WorkerResource;
use App\Http\Resources\V1\InterimResource;

class EmployeeController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if ($this->include('workers')) {
            return EmployeeResource::collection(Employee::where('employable_type', 'App\Models\Worker')->with('employable')->paginate());
        }
        
        if ($this->include('interims')) {
            return EmployeeResource::collection(Employee::where('employable_type', 'App\Models\Interim')->with('employable')->paginate());
        }

        return EmployeeResource::collection(Employee::paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return new EmployeeResource($employee);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
