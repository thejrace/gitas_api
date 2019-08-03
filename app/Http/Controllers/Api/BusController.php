<?php

namespace App\Http\Controllers\Api;

use App\Bus;
use App\Http\Controllers\Controller;
use App\Http\Resources\BusResource;
use App\Http\Requests\BusFormStoreRequest;
use App\Http\Requests\BusFormUpdateRequest;
use App\Http\Resources\SuccessJSONResponseResource;

class BusController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param Bus $model
     *
     * @return BusResource
     */
    public function show(Bus $model)
    {
        return new BusResource($model);
    }

    /**
     * Store a newly created model in storage.
     *
     * @param BusFormStoreRequest $request
     *
     * @return SuccessJSONResponseResource
     */
    public function store(BusFormStoreRequest $request)
    {
        Bus::create( $request->all() );
        return new SuccessJSONResponseResource(null);
    }

    /**
     * Update the specified location in storage.
     *
     * @param BusFormUpdateRequest  $request
     * @param Bus                   $model
     *
     * @return SuccessJSONResponseResource
     */
    public function update(BusFormUpdateRequest $request, Bus $model)
    {
        $model->update($request->all());
        return new SuccessJSONResponseResource(null);
    }

    /**
     * Remove app module
     *
     * @param Bus $model
     *
     * @return SuccessJSONResponseResource
     *
     * @throws \Exception|\Throwable
     */
    public function destroy(Bus $model)
    {
        $model->delete();
        return new SuccessJSONResponseResource(null);
    }
}
