<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => ['alpha_num', 'min:4', 'max:20'],
            'name' => ['min:4', 'max:50', "regex:/^([a-zA-Z'. ]+)$/"],
            'password' => ['alpha_num', 'min:8', 'max:16', 'confirmed']
        ];
    }
}
