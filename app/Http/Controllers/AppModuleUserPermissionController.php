<?php

namespace App\Http\Controllers;


use App\AppModuleUser;
use App\Http\Resources\PermissionResource;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class AppModuleUserPermissionController extends Controller
{
    public function dataTablesNotDefined( AppModuleUser $user ){
        $query = Permission::query();
        $userPerms = $user->getAllPermissions();
        $excludedArray = [];
        foreach( $userPerms as $perm ){
            $excludedArray[] = $perm->id;
        }
        $query->whereNotIn('id', $excludedArray);
        $query->where('name', 'LIKE', '%'.$user->AppModule->permission_prefix.'%');
        $query->whereIn('type', [2]); // @todo enum mu yapcan napcan yap amk
        return PermissionResource::collection($query->paginate(20));
    }

    public function dataTablesDefined( AppModuleUser $user ){
        return PermissionResource::collection($user->permissions()->paginate(20));
    }

    public function index(){
        return view('app_module_user_permissions');
    }
}
