<?php

namespace App\Http\Controllers;

use App\AppModule;
use App\AppModuleUser;

class AppModuleUserFormController extends Controller
{
    /**
     * Show empty form
     *
     * @param AppModule $appModule
     *
     * @return \View
     */
    public function create(AppModule $appModule)
    {
        return view('app_module_user_form');
    }

    /**
     * Show update form
     *
     * @param AppModule     $appModule
     * @param AppModuleUser $user
     *
     * @return \View
     */
    public function edit(AppModule $appModule, AppModuleUser $user)
    {
        return view('app_module_user_form')->with([
            'updateFlag' => true,
            'dataId'     => $user->id,
        ]);
    }
}
