<?php

namespace App\Http\Controllers;

use App\AppModuleUser;
class AppModuleUserFormController extends Controller
{
    public function create()
    {
        return view('app_module_user_form');
    }
    public function edit( AppModuleUser $user )
    {
        return view('app_module_user_form')->with([
            'updateFlag' => true,
            'dataId' => $user->id
        ]);
    }
}
