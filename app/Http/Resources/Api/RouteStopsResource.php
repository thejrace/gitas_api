<?php

namespace App\Http\Resources\Api;

use App\RouteStop;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RouteStopsResource extends ResourceCollection
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
            $this->collection->transform(function($stop) {
                /* @var RouteStop $stop */
                return [
                    'route'     => $stop->route->code,
                    'no'        => $stop->no,
                    'direction' => $stop->direction,
                    'name'      => $stop->name,
                ];
            }),
        ];
    }
}
