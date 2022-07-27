<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
        if (!empty(request()->change_status) && json_decode(request()->change_status) == true) {
            $rules = [];
        } else {
            $rules = [
                'title'        => 'required|max:150',
                'description'  => 'required|max:320',
                'content'      => 'required',
                // 'slug'         => 'nullable||alpha_dash|unique:products,slug,{$id}|max:100',
                'qty'          => 'integer',
                'price_base'   => 'required|numeric',
                'price_sale'   => 'nullable|numeric',
                'price_other'  => 'nullable|numeric',
                'term_id'      => 'nullable|integer',
            ];
        }
        
        return $rules;
    }
}
