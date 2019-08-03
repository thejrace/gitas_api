<?php

namespace App\Http\Controllers;

use App\PermissionType;
use Spatie\Permission\Models\Permission;

class PermissionFormController extends Controller
{
    /**
     * Show empty form
     *
     * @return \View
     */
    public function create()
    {
        return view('permission_form');
    }

    /**
     * Show update form
     *
     * @param PermissionType $permissionType
     * @param Permission $permission
     *
     * @return \View
     */
    public function edit(PermissionType $permissionType, Permission $permission)
    {
        return view('permission_form')->with([
            'updateFlag' => true,
            'dataId'     => $permission->id
        ]);
    }
}