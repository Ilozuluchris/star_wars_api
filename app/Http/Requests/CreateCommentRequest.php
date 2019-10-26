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

        #todo handle what happens if 500 is passed
        return [
                'content' => 'bail|required|string|max:500',
            ];


    }
}
