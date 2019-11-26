<?php

namespace App\Http\Resources;

use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property User $resource
 */
class LoginResource extends JsonResource
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
            'api_token'   => $this->resource->api_token,
            'user_id'     => $this->resource->id,
            'email'       => $this->resource->email,
            'name'        => $this->resource->name,
            'filo5_login' => 'dk_gitas', // @todo get from admin panel
            'filo5_pass'  => 'eVCb4Y/p',
        ];
    }
}
