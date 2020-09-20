<?php

namespace App\Http\Resources;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PhrasebookCollection;

class PhrasebookCategory extends JsonResource {
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
                'id'        => $this->id,
                'title'     => $this->title,
                'slug'      => $this->slug,
                'phrases'   => new PhrasebookCollection($this->phrases)
            ];
        }
        return [
            'id'    => $this->id,
            'title' => $this->title,
            'slug'  => $this->slug,
        ];
    }
}
