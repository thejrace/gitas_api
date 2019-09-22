<?php

namespace App\Http\Resources\Api;

use App\RouteScanner;
use Illuminate\Http\Resources\Json\JsonResource;

class RouteScannerResource extends JsonResource
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
            'id'     => $model->id,
            'code'   => $model->code,
            'status' => $model->status,
        ];
    }
}
