<?php

namespace App\Http\Resources;

use App\AppModuleUser;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property AppModuleUser $resource
 */
class AppModuleUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
