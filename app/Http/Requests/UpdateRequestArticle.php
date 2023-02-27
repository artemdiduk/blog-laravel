<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequestArticle extends FormRequest
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
            'group' => 'exists:App\Models\Group,slag|required',
            'name' => 'unique:App\Models\Post,name|required|min:3|string',
            'description' => 'required|min:4|max:2000|string',
            'img' => 'mimes:jpg,png'   
        ];
    }
}
