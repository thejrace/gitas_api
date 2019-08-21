<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionTypeFormStoreRequest;
use App\Http\Requests\PermissionTypeFormUpdateRequest;
use App\Http\Resources\PermissionTypeResource;
use App\Http\Resources\SuccessJSONResponseResource;
use App\PermissionType;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PermissionTypeController extends Controller
{
    /**
     * Get all Permission Types
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return PermissionTypeResource::collection(PermissionType::all());
    }

    /**
     * Display the specified resource.
     *
     * @param PermissionType $model
     *
     * @return PermissionTypeResource
     */
    public function show(PermissionType $model)
    {
        return new PermissionTypeResource($model);
    }

    /**
     * Store a newly created model in storage.
     *
     * @param PermissionTypeFormStoreRequest $request
     *
     * @return SuccessJSONResponseResource
     */
    public function store(PermissionTypeFormStoreRequest $request)
    {
        PermissionType::create($request->all());

        return new SuccessJSONResponseResource(null);
    }

    /**
     * Update the specified location in storage.
     *
     * @param PermissionTypeFormUpdateRequest $request
     * @param PermissionType                  $model
     *
     * @return SuccessJSONResponseResource
     */
    public function update(PermissionTypeFormUpdateRequest $request, PermissionType $model)
    {
        $model->update($request->all());

        return new SuccessJSONResponseResource(null);
    }

    /**
     * Remove permission type
     *
     * @param PermissionType $model
     *
     * @return SuccessJSONResponseResource
     *
     * @throws \Exception|\Throwable
     */
    public function destroy(PermissionType $model)
    {
        // $model->delete();
        // @todo implement
        // find sub permissions
        // find users with those permission and revoke them

        // also we dont want user to delete AppModulePerms and UserPerms..
        return new SuccessJSONResponseResource(null);
    }
}
