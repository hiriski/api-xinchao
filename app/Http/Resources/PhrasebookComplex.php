<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PhrasebookComplex extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'is_favorited'  => $this->is_favorited,
            'category_id'   => $this->category_id,
            'created_by'    => new User($this->whenLoaded('creator')),
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
            'text'      => [
                'id'    => $this->id_ID,
                'vi'    => $this->vi_VN,
                'en'    => $this->en_US,
                'notes' => $this->notes
            ],
        ];
    }
}
