<?php

namespace App\Http\Controllers\Api;

use App\AppModuleUser;
use App\Http\Requests\PermissionFormStoreRequest;
use App\Http\Resources\SuccessJSONResponseResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class AppModuleUserPermissionController extends Controller
{

    public function store(PermissionFormStoreRequest $request)
    {
        $apiUser = AppModuleUser::findOrFail($request->get('user_id'));
        $permisson = Permission::query()->where('id', $request->get('permission_id'))->first();
        $apiUser->givePermissionTo($permisson);
        return new SuccessJSONResponseResource(null);
    }
    public function destroy($id)
    {
        //
    }
}
