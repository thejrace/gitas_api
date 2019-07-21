<?php

namespace App\Http\Controllers\Api;

use App\Bus;
use App\Http\Controllers\Controller;
use App\Http\Resources\BusResource;
use App\Http\Requests\BusFormStoreRequest;
use App\Http\Requests\BusFormUpdateRequest;
use App\Http\Resources\SuccessJSONResponseResource;


class BusController extends Controller
{
    public function store(BusFormStoreRequest $request)
    {
        Bus::create( $request->all() );
        return new SuccessJSONResponseResource(null);
    }

    public function show($model)
    {
        return new BusResource($model);
    }

    public function update(BusFormUpdateRequest $request, Bus $model)
    {
        $model->update($request->all());
        return new SuccessJSONResponseResource(null);
    }

    public function destroy($model)
    {
        $model->delete();
        return new SuccessJSONResponseResource(null);
    }
}
