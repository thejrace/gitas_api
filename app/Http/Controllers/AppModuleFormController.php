<?php

namespace App\Http\Controllers;

use App\AppModule;

class AppModuleFormController extends Controller
{
    public function create()
    {
        return view('app_module_form');
    }
    public function edit( AppModule $appModule )
    {
        return view('app_module_form')->with([
            'updateFlag' => true,
            'dataId' => $appModule->id
        ]);
    }
}
