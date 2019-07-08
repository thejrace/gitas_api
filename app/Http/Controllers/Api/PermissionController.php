<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\PermissionFormRequest;
use App\User;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    public function store(PermissionFormRequest $request)
    {
        $perm = Permission::create(['name' => $request->get('name')]);
        return $perm;
    }

    public function update( PermissionFormRequest $request, $id ){
        $perm = Permission::findById($id);
        $perm->update($request->all());
        return $perm;
    }

    public function destroy($id)
    {
        $permission = Permission::findById($id);
        $users = User::permission($permission)->get();
        foreach( $users as $user ){
            $user->revokePermissionTo($permission);
        }
        $permission->delete();
    }


}
