<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Message extends JsonResource
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
            'text'      => $this->text,
            'user'      => new ChatUser($this->whenLoaded('user')),
            'send'      => true,
            'received'  => true,
            'createdAt' => $this->created_at,
        ];
    }
}
