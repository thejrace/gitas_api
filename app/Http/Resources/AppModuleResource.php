<?php

namespace App\Http\Resources;

use App\AppModule;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property AppModule $resource
 */
class AppModuleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $model = $this->resource;
        return [

            'id'                    => $model->id,
            'name'                  => $model->name,
            'description'           => $model->description,
            'permission_prefix'     => $model->permission_prefix,
        ];
    }
}
