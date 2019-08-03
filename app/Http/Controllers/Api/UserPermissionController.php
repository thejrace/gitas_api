<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\PermissionResource;
use App\Http\Resources\SuccessJSONResponseResource;
use App\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class UserPermissionController extends Controller
{
    /**
     * Get all permissions of the user.
     *
     * @param User $user
     *
     * @return AnonymousResourceCollection
     */
    public function getPermissions(User $user)
    {
        return PermissionResource::collection($user->permissions());
    }

    /**
     * Give specific permission to user.
     *
     * @param User $user
     * @param Permission $permission
     *
     * @return SuccessJSONResponseResource
     */
    public function givePermission(User $user, Permission $permission)
    {
        $user->givePermissionTo($permission);
        return new SuccessJSONResponseResource(null);
    }

    /**
     * Revoke specific permission from app module user.
     *
     * @param User $user
     * @param Permission $permission
     *
     * @return SuccessJSONResponseResource
     */
    public function revokePermission(User $user, Permission $permission)
    {
        $user->revokePermissionTo($permission);
        return new SuccessJSONResponseResource(null);
    }
}
