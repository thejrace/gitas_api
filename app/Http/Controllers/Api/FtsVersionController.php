<?php

namespace App\Http\Controllers\Api;

use App\FtsVersion;
use App\Http\Controllers\Controller;
use App\Http\Requests\FtsVersionFormRequest;
use App\Http\Resources\FtsVersionResource;
use App\Http\Resources\SuccessJSONResponseResource;

class FtsVersionController extends Controller
{
    /**
     * Get all versions
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return FtsVersionResource::collection(FtsVersion::all());
    }

    /**
     * Display the specified resource.
     *
     * @param FtsVersion $model
     *
     * @return FtsVersionResource
     */
    public function show(FtsVersion $model)
    {
        return new FtsVersionResource($model);
    }

    /**
     * Store a newly created model in storage.
     *
     * @param FtsVersionFormRequest $request
     *
     * @return SuccessJSONResponseResource
     */
    public function store(FtsVersionFormRequest $request)
    {
        FtsVersion::create($request->all());

        return new SuccessJSONResponseResource(null);
    }

    /**
     * Update the specified location in storage.
     *
     * @param FtsVersionFormRequest $request
     * @param FtsVersion            $model
     *
     * @return SuccessJSONResponseResource
     */
    public function update(FtsVersionFormRequest $request, FtsVersion $model)
    {
        $model->update($request->all());

        return new SuccessJSONResponseResource(null);
    }

    /**
     * Remove app module
     *
     * @param FtsVersion $model
     *
     * @return SuccessJSONResponseResource
     *
     * @throws \Exception
     */
    public function destroy(FtsVersion $model)
    {
        $model->delete();

        return new SuccessJSONResponseResource(null);
    }
}
