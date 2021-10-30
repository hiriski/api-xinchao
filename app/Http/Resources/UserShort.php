<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class UserShort extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'username'      => $this->username,
            'photo_url'     => $this->photo_url !== null ? URL::to('/') . '/storage/images/users/' . $this->photo_url : null,
            'level'         => $this->level,
            'role'          => new Role($this->whenLoaded('role')),
        ];
    }
}
