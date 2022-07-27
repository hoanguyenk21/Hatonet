<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
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
            'qty'         => 'required|integer',
            'price_base'  => 'required|numeric',
            'price_sale'  => 'required|numeric',
        ];
    }
}
