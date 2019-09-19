<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuccessJSONResponseResource;
use App\RouteStop;
use Illuminate\Http\Request;

class RouteStopController extends Controller
{
    /**
     * Store stops
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return SuccessJSONResponseResource
     */
    public function storeAsMass(Request $request)
    {
        // this will store multiple stops
        RouteStop::create($request->all());

        return new SuccessJSONResponseResource(null);
    }
}
