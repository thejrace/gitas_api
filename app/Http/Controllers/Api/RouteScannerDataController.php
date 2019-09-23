<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FailJSONResponseResource;
use App\Http\Resources\SuccessJSONResponseResource;
use App\Route;
use App\RouteIntersection;
use App\RouteStop;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class RouteScannerDataController extends Controller
{
    /**
     * Returns the data of the route scanner
     *
     * @param Request $request
     * @param string  $route
     */
    public function show(Request $request, $route)
    {
    }

    /**
     * @param Request $request
     * @param $route
     *
     * @return FailJSONResponseResource|SuccessJSONResponseResource
     */
    public function upload(Request $request)
    {
        $data = $request->input('data');

        $route = json_decode($data, 'true')['routeCode'];

        if (!$route) {
            return new FailJSONResponseResource(null);
        }

        Storage::put($route . '.json', $data, 'public');

        return new SuccessJSONResponseResource(null);
    }

    /**
     * Return the route scanenr data with intersected route's data
     *
     * @param Request $request
     * @param $route
     *
     * @return string
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function download(Request $request, $route)
    {
        $routeData = Cache::rememberForever('route_data?' . $route, function() use ($route) {
            // check route
            $routeQuery = Route::query();
            $routeData = $routeQuery->where('code', $route)->pluck('id');

            return $routeData;
        });

        if ($routeData[0]) {
            $routeStops = Cache::rememberForever('route_stops_' . $route, function() use ($routeData) {
                // download stops to determine intersection points
                $routeStopsQuery = RouteStop::query();

                return $routeStopsQuery->where('route_id', $routeData[0])
                    ->get();
            });

            // find direction merge point like RouteMap
            $prevDir             = 0;
            $directionMergePoint = -1;

            foreach ($routeStops as $stop) {
                if ($stop->direction !== $prevDir) {
                    break;
                }
                $prevDir = $stop->direction;
                $directionMergePoint++;
            }

            $intersections = Cache::rememberForever('intersections_' . $route, function() use ($routeData) {
                // download intersections
                $intersectionQuery = RouteIntersection::query();
                return $intersectionQuery->where('active_route_id', $routeData[0])
                    ->get(['intersected_route_id', 'direction', 'stop_name', 'total_diff'])
                    ->all();
            });

            $output = [
                'intersection_data'   => [],
                'data'                => Storage::get($route . '.json'),
                'directionMergePoint' => $directionMergePoint,
            ];

            /** @var RouteIntersection $intersection */
            foreach ($intersections as $intersection) {
                try {
                    $data = Storage::get($intersection->intersectedRoute->code . '.json');

                    // find the position of intersection stop in the active route's route map
                    $j = ($intersection->direction == 0) ? 0 : $directionMergePoint;
                    for (; $j < count($routeStops); $j++) {
                        if ($routeStops[$j]->name === $intersection->stop_name) {
                            break;
                        }
                    }
                    $output['intersection_data'][] = [
                        'intersected_route'  => $intersection->intersectedRoute->code,
                        'total_diff'         => $intersection->total_diff,
                        'direction'          => $intersection->direction,
                        'intersection_index' => $j,
                        'data'               => $data ?? '',
                    ];
                } catch (FileNotFoundException $e) {
                }
            }

            return response()->json($output);
        }

        return '[]';
    }
}
