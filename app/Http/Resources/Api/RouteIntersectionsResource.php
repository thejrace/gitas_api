<?php

namespace App\Http\Resources\Api;

use App\RouteIntersection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RouteIntersectionsResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            $this->collection->transform(function($intersection) {
                /* @var RouteIntersection $intersection */
                return [
                    'intersected_route' => $intersection->intersectedRoute->code,
                    'direction'         => $intersection->direction,
                    'stop_name'         => $intersection->stop_name,
                    'total_diff'        => $intersection->total_diff,
                ];
            }),
        ];
    }
}
