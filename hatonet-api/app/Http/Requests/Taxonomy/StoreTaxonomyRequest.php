<?php

namespace App\Http\Requests\Taxonomy;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

 class StoreTaxonomyRequest extends FormRequest
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
            'description' => 'nullable',
            'slug'        => 'required|max:100',
            'content'     => 'nullable',
        ];
    }
    public function messages(){
        return[
            'title.required' => "Vui lòng nhập tiêu đề",
            'slug.required' => "Vui lòng nhập đường dẫn",
        ];
}
}
