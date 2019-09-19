<?php

namespace App\Http\Resources\Api;

use App\Enums\RouteDirection;
use App\RouteStop;
use Illuminate\Http\Resources\Json\JsonResource;

class RouteStopResource extends JsonResource
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
        /** @var RouteStop $model */
        $model = $this->resource;

        return [
            'id'        => $model->id,
            'route'     => $model->route->code,
            'no'        => $model->no,
            'direction' => RouteDirection::getDescription($model->direction),
            'name'      => $model->name,
        ];
    }
}
