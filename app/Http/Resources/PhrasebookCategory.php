<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class PhrasebookCategory extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return [
            'id'        => $this->id,
            'color'     => $this->color,
            'icon_name' => $this->icon_name,
            'icon_type' => $this->icon_type,
            'text'      => [
                'id'    => $this->id_ID,
                'vi'    => $this->vi_VN,
                'en'    => $this->en_US,
                'description' => $this->description
            ],
        ];
    }
}
