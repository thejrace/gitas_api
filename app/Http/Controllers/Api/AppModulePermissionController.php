<?php

namespace App\Http\Controllers\Api;

use App\AppModulePermission;
use App\Http\Requests\AppModulePermissionStoreFormRequest;
use App\Http\Requests\AppModulePermissionUpdateFormRequest;
use App\Http\Resources\AppModulePermissionResource;
use App\Http\Controllers\Controller;

class AppModulePermissionController extends Controller
{
    public function index()
    {
        return AppModulePermissionResource::collection(AppModulePermission::all());
    }

    public function store(AppModulePermissionStoreFormRequest $request)
    {
        $model = AppModulePermission::create( $request->all() );
        return new AppModulePermissionResource($model);
    }

    public function show($id)
    {
        $model = AppModulePermission::find($id);
        return new AppModulePermissionResource($model);
    }

    public function update(AppModulePermissionUpdateFormRequest $request, $id)
    {
        $model = AppModulePermission::findOrFail($id);
        $model->update($request->all());
        return new AppModulePermissionResource($model);
    }

    public function destroy($id)
    {
        $model = AppModulePermission::findOrFail($id);
        $model->delete();
    }
}
