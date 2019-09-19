<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\RouteStopsResource;
use App\Http\Resources\FailJSONResponseResource;
use App\Http\Resources\SuccessJSONResponseResource;
use App\Route;
use App\RouteStop;
use Illuminate\Http\Request;

class RouteServiceController extends Controller
{
    /**
     * Get data from RouteServiceBot to sync routes one by one
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return SuccessJSONResponseResource
     */
    public function update(Request $request)
    {
        $routeObject = json_decode($request->input('data'), true);

        $query = Route::query();
        $query->where('code', $routeObject['code']);

        // if route does not exist, create it
        if ($query->count() == 0) {
            $route = Route::create([
                'code' => $routeObject['code'],
                'name' => $routeObject['name'],
            ]);

            // create stops ( @todo implement update mechanism )
            foreach ($routeObject['stops'] as $stopObject) {
                RouteStop::create([
                    'route_id'  => $route->id,
                    'no'        => $stopObject['no'],
                    'direction' => $stopObject['direction'],
                    'name'      => $stopObject['name'],
                ]);
            }
        }

        return new SuccessJSONResponseResource(null);
    }

    /**
     * Download the stops of given route
     *
     * @param Request $request
     * @param $route
     *
     * @return RouteStopsResource|FailJSONResponseResource
     */
    public function stops(Request $request)
    {
        if (!$request->has('routeCode')) {
            return new FailJSONResponseResource(null);
        }

        $query = Route::query();
        $query->where('code', $request->input('routeCode'));

        if ($query->count() == 0) {
            return new FailJSONResponseResource(null);
        }
        /** @var Route $route */
        $route = $query->first();

        $stopQuery = RouteStop::query();
        $stops     = $stopQuery->where('route_id', $route->id)->get();

        return new RouteStopsResource($stops);
    }
}
