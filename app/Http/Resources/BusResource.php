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
        return parent::toArray($request);
    }
}
