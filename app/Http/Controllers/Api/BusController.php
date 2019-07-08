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
        $model = Bus::create( $request->all() );
        return new BusResource($model);
    }

    public function show($id)
    {
        $model = Bus::find($id);
        return new BusResource($model);
    }

    public function update(BusFormUpdateRequest $request, $id)
    {
        $model = Bus::findOrFail($id);
        $model->update($request->all());
        return new BusResource($model);
    }

    public function destroy($id)
    {
        $model = Bus::findOrFail($id);
        $model->delete();
    }
}
