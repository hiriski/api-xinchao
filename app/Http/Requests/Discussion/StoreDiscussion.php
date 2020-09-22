<?php

namespace App\Http\Requests\Discussion;

use App\Http\Requests\ApiRequest;

class StoreDiscussion extends ApiRequest {
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
            'title'         => ['required', 'string', 'max:255'],
            'description'   => ['string'],
            'content'       => ['string'],
            'user_id'       => ['exists:users,id'],
            'topic_id'      => ['required', 'exists:topics,id']
        ];
    }
}
