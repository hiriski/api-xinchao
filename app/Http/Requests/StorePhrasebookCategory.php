<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiRequest;

class StorePhrasebookCategory extends ApiRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'title' => ['string', 'max:150', 'unique:phrasebook_categories,title'],
            'slug'  => ['string', 'unique:phrasebook_categories,slug'],
        ];
    }
}
