<?php

namespace App\Http\Controllers\Api;

use App\AppModule;
use App\Http\Requests\PermissionFormStoreRequest;
use App\Http\Requests\PermissionFormUpdateRequest;
use App\Http\Resources\PermissionResource;
use App\Http\Resources\SuccessJSONResponseResource;
use App\User;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param Permission $model
     *
     * @return PermissionResource
     */
    public function show(Permission $model)
    {
        return new PermissionResource($model);
    }

    /**
     * Store a newly created model in storage.
     *
     * @param PermissionFormStoreRequest $request
     *
     * @return SuccessJSONResponseResource
     */
    public function store(PermissionFormStoreRequest $request)
    {
        $type = $request->get('type');
        $name = $request->get('name');
        $guard = 'api';
        if( $type == 2 ){ // app_module permission @todo implement ENUMS
            $appModule  = AppModule::findOrFail($request->get("app_module_id"));
            $name       = $appModule->permission_prefix.'.'.$name;
            $guard      = 'app_module_user';
        }
        Permission::create([
            'name'              => $name,
            'guard_name'        => $guard,
            'type'              => $type,
            'description'       => $request->get('description')
        ]);
        return new SuccessJSONResponseResource(null);
    }

    /**
     * Update the specified location in storage.
     *
     * @param PermissionFormUpdateRequest  $request
     * @param Permission                   $model
     *
     * @return SuccessJSONResponseResource
     */
    public function update(PermissionFormUpdateRequest $request, Permission $model ){

        $model->update($request->all());
        return new SuccessJSONResponseResource(null);
    }

    /**
     * Remove permissions
     *
     * @param Permission $model
     *
     * @return SuccessJSONResponseResource
     *
     * @throws \Exception|\Throwable
     */
    public function destroy(Permission $model)
    {
        $users = User::permission($model)->get();
        /** @var User $user */
        foreach( $users as $user ){
            $user->revokePermissionTo($model);
        }
        $model->delete();
        return new SuccessJSONResponseResource(null);
    }
}
