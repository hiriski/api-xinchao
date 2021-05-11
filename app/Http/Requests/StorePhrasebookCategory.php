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
            'id_ID'     => ['string', 'max:150'],
            'vi_VN'     => ['string', 'max:150'],
            'en_US'     => ['string', 'max:150'],
        ];
    }
}
