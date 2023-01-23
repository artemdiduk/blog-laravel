<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRegisrationRequest extends FormRequest
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
            'name' => 'required|max:25|regex:/^[a-z]+$/i|string',
            'email' => 'required|email|string|unique:users',
            'password' => 'required|min:6|regex:/^[a-z]+$/i|string',
        ];
    }
}
