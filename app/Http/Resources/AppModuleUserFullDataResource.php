<?php

namespace App\Http\Resources;

use App\AppModuleUser;
use Illuminate\Http\Resources\Json\JsonResource;

class AppModuleUserFullDataResource extends JsonResource
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
        /** @var AppModuleUser $model */
        $model = $this->resource;

        return [
            'id'          => $model->id,
            'name'        => $model->name,
            'email'       => $model->email,
            'api_token'   => $model->api_token,
            'permissions' => PermissionResource::collection($model->getAllPermissions()),
        ];
    }
}
