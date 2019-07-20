<?php

namespace App\Http\Controllers;

use App\Bus;
use App\Http\Resources\BusResource;
use Illuminate\Http\Request;

class BusFormController extends Controller
{

    public function create()
    {
        return view('bus_form');
    }

    public function store(Request $request)
    {
        //
    }

    public function edit( Bus $bus )
    {
        return view('bus_form')->with([
            'updateFlag' => true,
            'dataId' => $bus->id
        ]);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
