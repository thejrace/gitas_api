<?php

namespace App\Http\Controllers;

use App\AppModule;
use Spatie\Permission\Models\Permission;

class AppModulePermissionFormController extends Controller
{
    /**
     * Show empty form
     *
     * @param AppModule $appModule
     *
     * @return \View
     */
    public function create(AppModule $appModule){
        return view('permission_form')->with([
            'appModule' => $appModule
        ]);
    }

    /**
     * Show update form
     *
     * @param AppModule $appModule
     * @param Permission $permission
     *
     * @return \View
     */
    public function edit(AppModule $appModule, Permission $permission){
        return view('permission_form')->with([
            'appModule' => $appModule,
            'dataId'    => $permission->id
        ]);
    }
}
