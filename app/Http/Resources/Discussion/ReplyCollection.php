<?php

namespace App\Http\Resources\Discussion;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ReplyCollection extends ResourceCollection {
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        // return parent::toArray($request);
        return $this->collection;
    }
}
