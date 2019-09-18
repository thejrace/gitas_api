<?php

namespace App\Http\Resources\Api;

use App\Enums\RouteDirection;
use App\RouteIntersection;
use Illuminate\Http\Resources\Json\JsonResource;

class RouteIntersectionResource extends JsonResource
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
        /** @var RouteIntersection $model */
        $model = $this->resource;

        return [
            'active_route'      => $model->activeRoute->code,
            'intersected_route' => $model->intersectedRoute->code,
            'direction'         => RouteDirection::getDescription($model->direction),
            'stop_name'         => $model->stop_name,
            'total_diff'        => $model->total_diff,
        ];
    }
}
