<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class User extends JsonResource
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
            'email'         => $this->email,
            'username'      => $this->username,
            'photo_url'     => $this->photo_url !== null ? URL::to('/') . '/storage/images/users/' . $this->photo_url : null,
            'cover_photo_url' => $this->cover_photo_url !== null ? URL::to('/') . '/storage/images/covers/' . $this->cover_photo_url : null,
            'social_account' => new SocialAccount($this->whenLoaded('socialAccount')),
            'status'        => $this->status,
            'level'         => $this->level,
            'role'          => new Role($this->whenLoaded('role')),
            'country'       => new Country($this->whenLoaded('country')),
            'gender'        => $this->gender,
            'phone_number'  => $this->phone_number,
            'birthday'      => $this->birthday,
            'about'         => $this->about,
            'phrases_count' => $this->phrases_count,
            'contributor_points' => $this->contributor_points,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ];
    }
}
