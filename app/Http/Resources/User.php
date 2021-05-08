<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        // return parent::toArray($request);
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'email'         => $this->email,
            'username'      => $this->username,
            'photo_url'     => $this->photo_url,
            'social_account'=> new SocialAccount($this->whenLoaded('socialAccount')),
            'level'         => $this->level,
            'gender'        => $this->gender,
            'phone_number'  => $this->phone_number,
            'birthday'      => $this->birthday,
            'about'         => $this->about,
            'created_at'    => $this->created_at,
        ];
    }
}
