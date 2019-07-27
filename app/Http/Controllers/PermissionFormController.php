<?php

namespace App\Http\Controllers;

use App\PermissionType;
use Spatie\Permission\Models\Permission;

class PermissionFormController extends Controller
{
    public function create()
    {
        return view('permission_form');
    }
    public function edit( PermissionType $permissionType, Permission $permission )
    {
        return view('permission_form')->with([
            'updateFlag' => true,
            'dataId' => $permission->id
        ]);
    }
}
