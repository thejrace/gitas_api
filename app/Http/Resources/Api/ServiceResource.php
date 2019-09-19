<?php

namespace App\Http\Resources\Api;

use App\Enums\ServiceType;
use App\Service;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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
        /** @var Service $model */
        $model = $this->resource;

        return [
            'id'     => $model->id,
            'name'   => $model->name,
            'type'   => ServiceType::getDescription($model->type),
            'status' => $model->status,
        ];
    }
}
