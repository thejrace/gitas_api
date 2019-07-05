<?php

namespace App\Http\Controllers\Api;

use App\Bus;
use App\Http\Controllers\Controller;
use App\Http\Resources\BusResource;
use App\Http\Requests\BusFormStoreRequest;
use App\Http\Requests\BusFormUpdateRequest;


class BusController extends Controller
{

    public function index()
    {
        return BusResource::collection(Bus::all());
    }

    public function store(BusFormStoreRequest $request)
    {
        $bus = Bus::create( $request->all() );
        return new BusResource($bus);
    }

    public function show($id)
    {
        $bus = Bus::find($id);
        return new BusResource($bus);
    }

    public function update(BusFormUpdateRequest $request, $id)
    {
        $bus = Bus::findOrFail($id);
        $bus->update($request->all());
        return new BusResource($bus);
    }

    public function destroy($id)
    {
        $bus = Bus::findOrFail($id);
        $bus->delete();
    }
}
