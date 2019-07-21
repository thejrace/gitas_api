<?php

namespace App\Http\Controllers;

use App\Bus;
class BusFormController extends Controller
{
    public function create()
    {
        return view('bus_form');
    }
    public function edit( Bus $bus )
    {
        return view('bus_form')->with([
            'updateFlag' => true,
            'dataId' => $bus->id
        ]);
    }
}
