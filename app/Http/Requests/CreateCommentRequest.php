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
                'commenter_ip'=>'bail|required|ipv4'
            ];


    }
}
