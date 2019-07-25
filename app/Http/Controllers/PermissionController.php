<?php

namespace App\Http\Controllers;


use App\Http\Resources\PermissionResource;
use App\PermissionType;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    /*public function dataTables( Request $request, User $user ){
        $Ids = [];
        foreach( $user->getAllPermissions() as $permission ) {
            $Ids[] = $permission->id;
        }
        $query = Permission::query();
        $query->whereNotIn('id', $Ids);
        return PermissionResource::collection($query->paginate(20));
    }*/

    public function dataTables( PermissionType $type ){
        $query = Permission::query();
        $query->where('type', $type->id );
        return PermissionResource::collection($query->paginate(20));
    }

    public function index( PermissionType $type ){
        return view('permissions')->with(['permission_type' => $type->id ] );
    }

}
