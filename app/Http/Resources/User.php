<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Route;
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
            $this->mergeWhen(
                (Route::currentRouteName() === 'user') ||
                (Route::current()->action['prefix'] === 'api/auth'), [
                    'id' => $this->id,
                    'email' => $this->email,
            ]),
            'name'      => $this->name,
            'username'  => $this->username,
        ];
    }
}
