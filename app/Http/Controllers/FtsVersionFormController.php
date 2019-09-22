<?php

namespace App\Http\Controllers;

use App\FtsVersion;

class FtsVersionFormController extends Controller
{
    /**
     * Show empty form
     *
     * @return \View
     */
    public function create()
    {
        return view('fts_version_form');
    }

    /**
     * Show update form
     *
     * @param FtsVersion $model
     *
     * @return \View
     */
    public function edit(FtsVersion $model)
    {
        return view('fts_version_form')->with([
            'updateFlag' => true,
            'dataId'     => $model->id,
        ]);
    }
}
