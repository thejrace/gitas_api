<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserPermissionFormRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class UserPermissionController extends Controller
{

    public function store(UserPermissionFormRequest $request)
    {
        $apiUser = User::findOrFail($request->get('user_id'));
        $permisson = Permission::findById($request->get('permission_id'));
        $apiUser->givePermissionTo($permisson);
    }

    public function show($id)
    {
        $apiUser = User::findOrFail($id);
        return $apiUser->getAllPermissions();
    }

    public function destroy($id)
    {

    }
}
