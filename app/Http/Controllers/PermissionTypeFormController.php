<?php

namespace App\Http\Controllers;

use App\PermissionType;

class PermissionTypeFormController extends Controller
{
    public function create(){
        return view('permission_type_form');
    }

    public function edit( PermissionType $permissionType )
    {
        return view('permission_type_form')->with([
            'updateFlag' => true,
            'dataId' => $permissionType->id
        ]);
    }
}
