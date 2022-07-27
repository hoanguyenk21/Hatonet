<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'title'        => 'required|max:150',
            'description'  => 'required|max:320',
            'content'      => 'required',
            'slug'         => 'nullable|unique:products',
            'qty'          => 'integer',
            // 'price_base'   => 'required|numeric',
            'price_sale'   => 'nullable|numeric',
            // 'price_other'  => 'nullable|numeric',
            'term_id'      => 'nullable|integer',
        ];
    }
}
