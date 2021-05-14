<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Conversation extends JsonResource
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
            'id'                => $this->id,
            'channel_id'        => $this->channel_id,
            'conversation_type' => $this->conversation_type,
            'participants'      => new ParticipantCollection($this->whenLoaded('participants')),
            'last_message'      => new Message($this->last_message),
        ];
    }
}
