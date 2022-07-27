<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdatePostRequest extends FormRequest
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
            'title'       => 'required|max:150',
            'description' => 'required|max:320',
            'content'     => 'nullable',
            // 'slug'        => 'required||alpha_dash|unique:posts,slug,{$id}|max:100',
            // 'thumbnail'   => 'nullable|image:jpg,jpeg,png,svg,webp|max:100',
            //'image'       => 'nullable|image:jpg,jpeg,png,svg,webp|max:100',
            'term_id'      => 'nullable|integer',
            'status'      => 'required',
            // 'meta_key'    => 'required|max:50',
        ];
    }
    public function messages(){
        return[
            'title.required' => "Không được để trống",
            'description.required' => "Không được để trống",
            'content.required' => "Không được để trống",
            'slug.required' => "Không được để trống",
            'thumbnail.required' => "Không được để trống",
            'image.required' => "Không được để trống",
            'term_id.required' => "Không được để trống",
            'status.required' => "Không được để trống",
        ];
}
}
