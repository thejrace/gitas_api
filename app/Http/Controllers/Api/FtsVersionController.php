<?php

namespace App\Http\Controllers\Api;

use App\FtsVersion;
use App\Http\Controllers\Controller;
use App\Http\Requests\FtsVersionStoreFormRequest;
use App\Http\Requests\FtsVersionUpdateFormRequest;
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
     * @param FtsVersionStoreFormRequest $request
     *
     * @return SuccessJSONResponseResource
     */
    public function store(FtsVersionStoreFormRequest $request)
    {
        FtsVersion::create($request->except('file'));

        return new SuccessJSONResponseResource(null);
    }

    /**
     * Update the specified location in storage.
     *
     * @param FtsVersionUpdateFormRequest $request
     * @param FtsVersion                  $model
     *
     * @return SuccessJSONResponseResource
     */
    public function update(FtsVersionUpdateFormRequest $request, FtsVersion $model)
    {
        $model->update($request->except('file'));

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
