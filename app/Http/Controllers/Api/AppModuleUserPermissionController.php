<?php

namespace App\Http\Controllers\Api;

use App\AppModuleUser;
use App\Http\Resources\PermissionResource;
use App\Http\Resources\SuccessJSONResponseResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\Permission\Models\Permission;

class AppModuleUserPermissionController extends Controller
{
    /**
     * Get all permissions of the app module user.
     *
     * @param AppModuleUser $user
     *
     * @return AnonymousResourceCollection
     */
    public function getPermissions( AppModuleUser $user )
    {
        return PermissionResource::collection($user->permissions());
    }

    /**
     * Give specific permission to app module user.
     *
     * @param AppModuleUser $user
     * @param Permission $permission
     *
     * @return SuccessJSONResponseResource
     */
    public function givePermission( AppModuleUser $user, Permission $permission )
    {
        $user->givePermissionTo($permission);
        return new SuccessJSONResponseResource(null);
    }

    /**
     * Revoke specific permission from app module user.
     *
     * @param AppModuleUser $user
     * @param Permission $permission
     *
     * @return SuccessJSONResponseResource
     */
    public function revokePermission( AppModuleUser $user, Permission $permission )
    {
        $user->revokePermissionTo($permission);
        return new SuccessJSONResponseResource(null);
    }
}
