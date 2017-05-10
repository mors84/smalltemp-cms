<?php

namespace App\Http\Requests;

use Auth;
use App\Tag;
use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
        $tag = Tag::find($this->tag);

        switch ($this->method()) {
            case 'POST':
            return [
                'name'                      =>  'required|max:50|unique:tags,name',
                'metadata_title'            =>  'max:255|unique:metadata,title',
                'metadata_description'      =>  'max:255',
                'metadata_keywords'         =>  'max:255',
            ];
            break;
            case 'PATCH':
            case 'PUT':
            return [
                'name'                      =>  'required|max:50|unique:tags,name,' . $tag->id,
                'metadata_title'            =>  'max:255|unique:metadata,title,' . $tag->metadata->id,
                'metadata_description'      =>  'max:255',
                'metadata_keywords'         =>  'max:255',
            ];
            break;
            default:break;
        }
    }
}
