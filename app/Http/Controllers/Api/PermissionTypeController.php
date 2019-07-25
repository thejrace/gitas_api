<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\PermissionTypeFormStoreRequest;
use App\Http\Requests\PermissionTypeFormUpdateRequest;
use App\Http\Resources\PermissionTypeResource;
use App\Http\Resources\SuccessJSONResponseResource;
use App\PermissionType;
use App\Http\Controllers\Controller;

class PermissionTypeController extends Controller
{
    public function index(){
        return PermissionTypeResource::collection(PermissionType::all());
    }

    public function show( PermissionType $model ){
        return new PermissionTypeResource($model);
    }

    public function store( PermissionTypeFormStoreRequest $request ){
        PermissionType::create($request->all());
        return new SuccessJSONResponseResource(null);
    }

    public function update( PermissionTypeFormUpdateRequest $request, PermissionType $model ){
        $model->update($request->all());
        return new SuccessJSONResponseResource(null);
    }

    public function destroy( PermissionType $model ){
        $model->delete();
    }
}
