<?php

namespace App\Http\Controllers;

use App\AppModule;

class AppModuleFormController extends Controller
{
    /**
     * Show empty form
     *
     * @return \View
     */
    public function create()
    {
        return view('app_module_form');
    }

    /**
     * Show update form
     *
     * @param AppModule $appModule
     *
     * @return \View
     */
    public function edit(AppModule $appModule)
    {
        return view('app_module_form')->with([
            'updateFlag' => true,
            'dataId'     => $appModule->id,
        ]);
    }
}
