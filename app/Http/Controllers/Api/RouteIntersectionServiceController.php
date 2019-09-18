<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\RouteIntersectionsResource;
use App\Http\Resources\FailJSONResponseResource;
use App\Http\Resources\SuccessJSONResponseResource;
use App\Route;
use App\RouteIntersection;
use Illuminate\Http\Request;

class RouteIntersectionServiceController extends Controller
{
    /**
     * Get data from RouteServiceBot to sync route intersections
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return SuccessJSONResponseResource|FailJSONResponseResource
     */
    public function update(Request $request)
    {
        $intersectionObject = json_decode($request->input('data'), true);

        $query = RouteIntersection::query();

        $activeRouteQuery = Route::query();
        $activeRouteQuery->where('code', $intersectionObject['active_route']);
        if ($activeRouteQuery->count() == 0) {
            return new FailJSONResponseResource(null);
        }

        $intersectedRouteQuery = Route::query();
        $intersectedRouteQuery->where('code', $intersectionObject['intersected_route']);
        if ($intersectedRouteQuery->count() == 0) {
            return new FailJSONResponseResource(null);
        }

        /** @var Route $activeRoute */
        $activeRoute = $activeRouteQuery->first();
        /** @var Route $intersectedRoute */
        $intersectedRoute = $intersectedRouteQuery->first();

        $query->where('active_route_id', $activeRoute->id)
            ->where('intersected_route_id', $intersectedRoute->id);

        // if intersection data does not exists, create it
        if ($query->count() == 0) {
            RouteIntersection::create([
                'active_route_id'      => $activeRoute->id,
                'intersected_route_id' => $intersectedRoute->id,
                'direction'            => $intersectionObject['direction'],
                'stop_name'            => $intersectionObject['stop_name'],
                'total_diff'           => $intersectionObject['total_diff'],
            ]);
        }

        return new SuccessJSONResponseResource(null);
    }

    /**
     * Download the stops of given route
     *
     * @param Request $request
     * @param $route
     *
     * @return RouteIntersectionsResource|FailJSONResponseResource
     */
    public function fetch(Request $request, $route)
    {
        $query = Route::query();
        $query->where('code', $route);

        if ($query->count() == 0) {
            return new FailJSONResponseResource(null);
        }
        /** @var Route $route */
        $route = $query->first();

        $intersectionQuery = RouteIntersection::query();
        $intersections     = $intersectionQuery->where('active_route_id', $route->id)->get();

        return new RouteIntersectionsResource($intersections);
    }
}
