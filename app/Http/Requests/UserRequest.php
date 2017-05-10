<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
                    'name'                      =>  'required|alpha_dash|max:255|unique:users,name',
                    'first_name'                =>  'max:255',
                    'last_name'                 =>  'max:255',
                    'email'                     =>  'required|email|max:255|unique:users,email',
                    'password'                  =>  'required|between:6,20|confirmed',
                    'url'                       =>  'max:255',
                    'description'               =>  'max:700',
                    'is_active'                 =>  'boolean',
                    'role_id'                   =>  'integer',
                    'photo_id'                  =>  'image|max:4000',
                    'alt_attribute'             =>  'max:255',
                    'title_attribute'           =>  'max:255',
                    'profile_links'             =>  'array|max:255',
                ];
                break;
            case 'PATCH':
            case 'PUT':
                return [
                    'name'                      =>  'required|alpha_dash|max:255|unique:users,name,' . $this->user,
                    'first_name'                =>  'max:255',
                    'last_name'                 =>  'max:255',
                    'email'                     =>  'required|email|max:255|unique:users,email,' . $this->user,
                    'url'                       =>  'max:255',
                    'description'               =>  'max:700',
                    'is_active'                 =>  'boolean',
                    'role_id'                   =>  'integer',
                    'photo_id'                  =>  'image|max:4000',
                    'alt_attribute'             =>  'max:255',
                    'title_attribute'           =>  'max:255',
                    'profile_links'             =>  'array|max:255',
                ];
                break;
            default:break;
        }
    }
}
