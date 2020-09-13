<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\ApiRequest;

class RegisterUser extends ApiRequest {
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
            'name'      => ['required', 'string'],
            'username'  => ['nullable', 'string', 'alpha_num', 'unique:users,username'],
            'email'     => ['required', 'email', 'unique:users,email'],
            'password'  => ['required', 'confirmed'],
        ];
    }
}
