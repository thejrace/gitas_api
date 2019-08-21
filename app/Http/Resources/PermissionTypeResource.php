<?php

namespace App\Http\Resources;

use App\PermissionType;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property PermissionType $resource
 */
class PermissionTypeResource extends JsonResource
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
            'id'          => $this->resource->id,
            'name'        => $this->resource->name,
            'description' => $this->resource->description,
        ];
    }
}
