<?php

namespace App\Http\Controllers;

use App\Http\Resources\PermissionResource;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class UserPermissionController extends Controller
{
    public function dataTablesNotDefined( User $user ){
        $query = Permission::query();
        $userPerms = $user->getAllPermissions();
        $excludedArray = [];
        foreach( $userPerms as $perm ){
            $excludedArray[] = $perm->id;
        }
        $query->whereNotIn('id', $excludedArray);
        $query->whereIn('type', [1]); // @todo enum mu yapcan napcan yap amk
        return PermissionResource::collection($query->paginate(20));
    }

    public function dataTablesDefined( User $user ){
        return PermissionResource::collection($user->permissions()->paginate(20));
    }

    public function index(){
        return view('user_permissions');
    }

}
