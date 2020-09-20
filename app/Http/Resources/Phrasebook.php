<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Resources\Json\JsonResource;

class Phrasebook extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        // return parent::toArray($request);
        if(Route::currentRouteName() === 'phrasebook.category.show') {
            return [
                'id'    => $this->id_ID,
                'vi'    => $this->vi_VN,
                'en'    => $this->en_US,
                'notes' => $this->notes
            ];
        } 
        return [
            'id'        => $this->id,
            'category'  => $this->category,
            'text'      => [
                'id'    => $this->id_ID,
                'vi'    => $this->vi_VN,
                'en'    => $this->en_US,
                'notes' => $this->notes
            ],
        ];
    }
}
