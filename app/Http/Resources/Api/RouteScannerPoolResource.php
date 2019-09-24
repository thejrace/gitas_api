<?php

namespace App\Http\Resources\Api;

use App\RouteScanner;
use Illuminate\Http\Resources\Json\JsonResource;

class RouteScannerPoolResource extends JsonResource
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
        /** @var RouteScanner $model */
        $model = $this->resource;

        return [
            'code'   => $model->code,
            'status' => (bool)$model->status,
        ];
    }
}
