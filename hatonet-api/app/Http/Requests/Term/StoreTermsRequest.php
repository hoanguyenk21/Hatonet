<?php

namespace App\Http\Requests\Term;

use Illuminate\Foundation\Http\FormRequest;

class StoreTermsRequest extends FormRequest
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
            'type' => 'required|max:100',
            'slug'        => 'required|max:100',
            'content'     => 'nullable',
        ];
    }
}
