<?php

namespace App\Http\Controllers;

use App\Bus;
class BusFormController extends Controller
{
    /**
     * Show empty form
     *
     * @return \View
     */
    public function create()
    {
        return view('bus_form');
    }

    /**
     * Show update form
     *
     * @param Bus $bus
     *
     * @return \View
     */
    public function edit(Bus $bus)
    {
        return view('bus_form')->with([
            'updateFlag'    => true,
            'dataId'        => $bus->id
        ]);
    }
}
