<?php

namespace App\Http\Controllers;

use App\Http\Resources\PermissionResource;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    public function dataTables( Request $request, User $user ){
        $Ids = [];
        foreach( $user->getAllPermissions() as $permission ) {
            $Ids[] = $permission->id;
        }
        $query = Permission::query();
        $query->whereNotIn('id', $Ids);
        return PermissionResource::collection($query->paginate(20));
    }

}
