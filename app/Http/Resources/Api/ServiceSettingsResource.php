<?php

namespace App\Http\Resources\Api;

use App\Service;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceSettingsResource extends JsonResource
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
            'name'      => $model->name,
            'api_token' => $model->api_token,
            'settings'  => json_decode($model->settings),
            'status'    => (bool)$model->status,
        ];
    }
}
