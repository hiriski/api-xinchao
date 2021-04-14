<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SocialAccount extends JsonResource
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
            'social_id'         => $this->social_id,
            'social_name'       => $this->social_name,
            'social_provider'   => $this->social_provider,
            'social_photo_url'  => $this->social_photo_url,
        ];
    }
}
