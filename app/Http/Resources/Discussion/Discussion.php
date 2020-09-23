<?php

namespace App\Http\Resources\Discussion;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Discussion\ReplyCollection;
use App\Http\Resources\Discussion\Topic as TopicResource;
use App\Http\Resources\User as UserResource;

class Discussion extends JsonResource {
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
            'title'         => $this->title,
            'description'   => $this->description,
            'content'       => $this->content,
            'topic'         => new TopicResource($this->whenLoaded('topic')),
            'user'          => new UserResource($this->whenLoaded('user')),
            'replies_count' => $this->replies_count,
            'is_favorited'  => $this->is_favorited,
            'replies'       => $this->when(Route::currentRouteName() === 'discussion.show', function() {
                return new ReplyCollection($this->whenLoaded('replies'));
            }),
        ];
    }
}
