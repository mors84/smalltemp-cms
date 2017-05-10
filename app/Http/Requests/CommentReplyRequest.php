<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentReplyRequest extends FormRequest
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
            'author'        =>  'required|max:50',
            'email'         =>  'email|max:255',
            'content'       =>  'max:1500',
            'comment_id'    =>  'required|numeric|exists:comments,id',
        ];
    }
}
