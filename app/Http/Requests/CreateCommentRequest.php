<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCommentRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                'content' => 'bail|required|string|max:500',
            ];


    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        #todo: include in error json
        return [
            'content.required' => 'Content is required',
            'content.string'  => 'Content must be string not '.gettype($this->input('content')),
            'content.max' => 'Content has a maximum length of 500'
        ];
    }
}
