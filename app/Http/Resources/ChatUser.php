<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class ChatUser extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
        return [
            '_id'       => $this->id,
            'name'      => $this->name,
            'avatar'    => $this->photo_url !== null ? URL::to('/') . '/storage/images/users/' . $this->photo_url : null
        ];
    }
}
