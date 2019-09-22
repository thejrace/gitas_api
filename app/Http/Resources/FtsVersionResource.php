<?php

namespace App\Http\Resources;

use App\FtsVersion;
use Illuminate\Http\Resources\Json\JsonResource;

class FtsVersionResource extends JsonResource
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
        /** @var FtsVersion $model */
        $model = $this->resource;

        return [
            'id'           => $model->id,
            'major'        => $model->major,
            'minor'        => $model->minor,
            'patch'        => $model->patch,
            'change_log'   => $model->change_log,
            'release_date' => $model->created_at,
        ];
    }
}
