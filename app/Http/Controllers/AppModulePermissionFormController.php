<?php

namespace App\Http\Controllers;

use App\AppModule;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class AppModulePermissionFormController extends Controller
{
    public function create( AppModule $appModule ){
        return view('permission_form')->with([
            'appModule' => $appModule
        ]);
    }

    public function edit( AppModule $appModule, Permission $permission ){
        return view('permission_form')->with([
            'appModule' => $appModule,
            'dataId' => $permission->id
        ]);
    }
}
