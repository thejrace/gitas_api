<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserPermissionFormRequest;
use App\Http\Resources\PermissionResource;
use App\Http\Resources\SuccessJSONResponseResource;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class UserPermissionController extends Controller
{

    public function givePermission( User $user, Permission $permission )
    {
        $user->givePermissionTo($permission);
        return new SuccessJSONResponseResource(null);
    }

    public function getPermissions( User $user )
    {
        return new PermissionResource($user->permissions());
    }

    public function revokePermission( User $user, Permission $permission )
    {
        $user->revokePermissionTo($permission);
        return new SuccessJSONResponseResource(null);
    }
}
