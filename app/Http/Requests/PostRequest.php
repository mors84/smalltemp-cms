<?php

namespace App\Http\Requests;

use Auth;
use App\Post;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        $post = Post::find($this->post);

        switch ($this->method()) {
            case 'POST':
            return [
                'title'                     =>  'required|max:255|unique:posts,title',
                'content'                   =>  'required',
                'slug'                      =>  'max:255|unique:posts,slug',
                'is_active'                 =>  'boolean',
                'category_id'               =>  'integer',
                'tags'                      =>  'array',
                'metadata_title'            =>  'max:255|unique:metadata,title',
                'metadata_description'      =>  'max:255',
                'metadata_keywords'         =>  'max:255',
                'alt_attribute'             =>  'max:255',
                'title_attribute'           =>  'max:255',
                'photo_id'                  =>  'required|image|max:4000',
            ];
            break;
            case 'PATCH':
            case 'PUT':
            return [
                'title'                     =>  'required|max:255|unique:posts,title,' . $post->id,
                'content'                   =>  'required',
                'slug'                      =>  'max:255|unique:posts,slug,' . $post->id,
                'is_active'                 =>  'boolean',
                'category_id'               =>  'integer',
                'tags'                      =>  'array',
                'metadata_title'            =>  'max:255|unique:metadata,title,' . $post->metadata->id,
                'metadata_description'      =>  'max:255',
                'metadata_keywords'         =>  'max:255',
                'alt_attribute'             =>  'max:255',
                'title_attribute'           =>  'max:255',
                'photo_id'                  =>  'image|max:4000',
            ];
            break;
            default:break;
        }
    }
}
