<?php

namespace App\Http\Controllers\Api;

use App\Bus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BusPlateFormRequest;
use App\Http\Resources\SuccessJSONResponseResource;

class BusPlateController extends Controller
{
    /**
     * Updates the plate data of the bus
     *
     * @param BusPlateFormRequest $request
     * @param Bus                 $model
     *
     * @return SuccessJSONResponseResource
     */
    public function update(BusPlateFormRequest $request, Bus $model)
    {
        $model->update($request->all());

        return new SuccessJSONResponseResource(null);
    }
}
