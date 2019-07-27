<?php

namespace App\Http\Controllers;

use App\AppModule;
use App\AppModuleUser;
class AppModuleUserFormController extends Controller
{
    public function create( AppModule $appModule )
    {
        return view('app_module_user_form');
    }
    public function edit( AppModule $appModule, AppModuleUser $user )
    {
        return view('app_module_user_form')->with([
            'updateFlag' => true,
            'dataId' => $user->id
        ]);
    }
}
