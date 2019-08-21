<?php

namespace App\Http\Controllers;

use App\Http\Resources\PermissionResource;
use App\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\Permission\Models\Permission;

class UserPermissionController extends Controller
{
    /**
     * Generate datatables data that contains permissions that
     * user does not have
     *
     * @param User $user
     *
     * @return AnonymousResourceCollection
     *
     * @throws \Exception|\Throwable
     */
    public function dataTablesNotDefined(User $user)
    {
        $query         = Permission::query();
        $userPerms     = $user->getAllPermissions();
        $excludedArray = [];
        foreach ($userPerms as $perm) {
            $excludedArray[] = $perm->id;
        }
        $query->whereNotIn('id', $excludedArray);
        $query->whereIn('type', [1]); // @todo enum mu yapcan napcan yap amk
        return PermissionResource::collection($query->paginate(20));
    }

    /**
     * Generate datatables data that contains permissions that
     * user has
     *
     * @param User $user
     *
     * @return AnonymousResourceCollection
     *
     * @throws \Exception|\Throwable
     */
    public function dataTablesDefined(User $user)
    {
        return PermissionResource::collection($user->permissions()->paginate(20));
    }

    /**
     * Show index view
     *
     * @return \View
     */
    public function index()
    {
        return view('user_permissions');
    }
}
