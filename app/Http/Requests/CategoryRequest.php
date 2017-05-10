<?php

namespace App\Http\Requests;

use Auth;
use App\Category;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $category = Category::find($this->category);

        switch ($this->method()) {
            case 'POST':
            return [
                'name'                     =>  'required|max:50|unique:categories,name',
                'metadata_title'           =>  'max:255|unique:metadata,title',
                'metadata_description'     =>  'max:255',
                'metadata_keywords'        =>  'max:255',
                'photo_id'                 =>  'image|max:4000',
            ];
            break;
            case 'PATCH':
            case 'PUT':
            return [
                'name'                     =>  'required|max:50|unique:categories,name,' . $category->id,
                'metadata_title'           =>  'max:255|unique:metadata,title,' . $category->metadata->id,
                'metadata_description'     =>  'max:255',
                'metadata_keywords'        =>  'max:255',
                'photo_id'                 =>  'image|max:4000',
            ];
            break;
            default:break;
        }
    }
}
