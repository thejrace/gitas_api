<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\PermissionFormStoreRequest;
use App\Http\Requests\PermissionFormUpdateRequest;
use App\Http\Resources\PermissionResource;
use App\Http\Resources\SuccessJSONResponseResource;
use App\User;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    public function store(PermissionFormStoreRequest $request)
    {
        Permission::create(['name' => $request->get('name'), 'guard_name' => 'api', 'type' => $request->get('type')]);
        return new SuccessJSONResponseResource(null);
    }

    public function show( Permission $model)
    {
        return new PermissionResource($model);
    }

    public function update(PermissionFormUpdateRequest $request, Permission $model ){

        $model->update($request->all());
        return new SuccessJSONResponseResource(null);
    }

    public function destroy( Permission $model )
    {
        $users = User::permission($model)->get();
        foreach( $users as $user ){
            $user->revokePermissionTo($model);
        }
        $model->delete();
        return new SuccessJSONResponseResource(null);
    }

}
