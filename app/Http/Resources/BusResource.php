<?php

namespace App\Http\Resources;

use App\Bus;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Bus $resource
 */
class BusResource extends JsonResource
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
        $model = $this->resource;

        return [
            'id'             => $model->id,
            'code'           => $model->code,
            'active_plate'   => $model->active_plate,
            'official_plate' => $model->official_plate,
        ];
    }
}
