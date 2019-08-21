<?php

namespace App\Http\Controllers;

use App\AppModuleUser;
use App\Http\Resources\PermissionResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\Permission\Models\Permission;

class AppModuleUserPermissionController extends Controller
{
    /**
     * Generate datatables data that contains permissions that
     * app module user does not have
     *
     * @param AppModuleUser $user
     *
     * @return AnonymousResourceCollection
     *
     * @throws \Exception|\Throwable
     */
    public function dataTablesNotDefined(AppModuleUser $user)
    {
        $query         = Permission::query();
        $userPerms     = $user->getAllPermissions();
        $excludedArray = [];
        /** @var Permission $perm */
        foreach ($userPerms as $perm) {
            $excludedArray[] = $perm->id;
        }
        $query->whereNotIn('id', $excludedArray);
        $query->where('name', 'LIKE', '%' . $user->AppModule->permission_prefix . '%');
        $query->whereIn('type', [2]); // @todo enum mu yapcan napcan yap amk
        return PermissionResource::collection($query->paginate(20));
    }

    /**
     * Generate datatables data that contains permissions that
     * app module user has
     *
     * @param AppModuleUser $user
     *
     * @return AnonymousResourceCollection
     *
     * @throws \Exception|\Throwable
     */
    public function dataTablesDefined(AppModuleUser $user)
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
        return view('app_module_user_permissions');
    }
}
