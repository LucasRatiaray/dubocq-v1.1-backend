<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Interim;
use App\Http\Requests\Api\V1\StoreInterimRequest;
use App\Http\Requests\Api\V1\UpdateInterimRequest;
use App\Http\Resources\V1\InterimResource;

class InterimController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return InterimResource::collection(Interim::paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInterimRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Interim $interim)
    {
        return new InterimResource($interim);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInterimRequest $request, Interim $interim)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Interim $interim)
    {
        //
    }
}
