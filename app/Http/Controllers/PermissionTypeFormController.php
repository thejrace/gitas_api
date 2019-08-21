<?php

namespace App\Http\Controllers;

use App\PermissionType;

class PermissionTypeFormController extends Controller
{
    /**
     * Show empty form
     *
     * @return \View
     */
    public function create()
    {
        return view('permission_type_form');
    }

    /**
     * Show update form
     *
     * @param PermissionType $permissionType
     *
     * @return \View
     */
    public function edit(PermissionType $permissionType)
    {
        return view('permission_type_form')->with([
            'updateFlag' => true,
            'dataId'     => $permissionType->id,
        ]);
    }
}
