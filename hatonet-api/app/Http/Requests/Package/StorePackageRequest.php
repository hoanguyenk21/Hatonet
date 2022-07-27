<?php

namespace App\Http\Requests\Package;

use Illuminate\Foundation\Http\FormRequest;

class StorePackageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
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
            'description' => 'nullable|max:320',
            'content'     => 'nullable',
            'slug'        => 'required|unique:packages|max:100',
            'image'       => 'nullable|image:jpg,jpeg,png,svg,webp',
            'price_base'  => 'required|integer',
            'price_sale'  => 'integer',
            'price_other' => 'integer',
            'status'      => 'required',
        ];
    }
}
