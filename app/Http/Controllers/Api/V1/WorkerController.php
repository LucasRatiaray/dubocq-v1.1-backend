<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Worker;
use App\Http\Requests\Api\V1\StoreWorkerRequest;
use App\Http\Requests\Api\V1\UpdateWorkerRequest;
use App\Http\Resources\V1\WorkerResource;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return WorkerResource::collection(Worker::paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWorkerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Worker $worker)
    {
        $worker->load('employee.projects');

        return new WorkerResource($worker);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkerRequest $request, Worker $worker)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Worker $worker)
    {
        //
    }
}
