<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class PhotoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
            return [
                'path'                      =>  'required|image|max:4000',
                'alt'                       =>  'max:255',
                'title'                     =>  'max:255',
                'tags'                      =>  'array',
            ];
            break;
            case 'PATCH':
            case 'PUT':
            return [
                'alt'                       =>  'max:255',
                'title'                     =>  'max:255',
                'tags'                      =>  'array',
            ];
            break;
            default:break;
        }
    }
}
