<?php

namespace App\Http\Controllers\Api;

use App\AppModuleUserPermission;
use App\Http\Controllers\Controller;
use App\Http\Requests\AppModuleUserPermissionStoreFormRequest;
use App\Http\Requests\AppModuleUserPermissionUpdateFormRequest;
use App\Http\Resources\AppModuleUserPermissionResource;

class AppModuleUserPermissionController extends Controller
{
    public function index()
    {
        return AppModuleUserPermissionResource::collection(AppModuleUserPermission::all());
    }

    public function store(AppModuleUserPermissionStoreFormRequest $request)
    {
        $model = AppModuleUserPermission::create( $request->all() );
        return new AppModuleUserPermissionResource($model);
    }

    public function show($id)
    {
        $model = AppModuleUserPermission::find($id);
        return new AppModuleUserPermissionResource($model);
    }

    public function update(AppModuleUserPermissionUpdateFormRequest $request, $id)
    {
        $model = AppModuleUserPermission::findOrFail($id);
        $model->update($request->all());
        return new AppModuleUserPermissionResource($model);
    }

    public function destroy($id)
    {
        $model = AppModuleUserPermission::findOrFail($id);
        $model->delete();
    }
}
