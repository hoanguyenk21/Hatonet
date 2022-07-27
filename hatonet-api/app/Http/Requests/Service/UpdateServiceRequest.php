<?php

namespace App\Http\Requests\Service;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
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
            'title'         => 'required|max:150',
            'description'   => 'required',
            'service_start' => 'required|date',
            'service_end'   => 'required|date|after:service_start',
            'price_base'    => 'required|numeric|gt:price_sale|min:0.00|max:1000000000.00',
            'price_sale'    => 'required|numeric|min:0.00|max:1000000000.00',
            'qty'           => 'integer',
            'status'        => 'required',
            'service_renew' => 'boolean',
        ];
    }

    public function messages()
    {
        return [
            
            'price_base.min' => 'Giá gốc phải lớn hơn 0.00',
            'price_base.max' => 'Giá gốc không được lớn hơn 1000000000.00',
            'price_sale.min' => 'Giá khuyến mãi phải lớn hơn 0.00',
            'price_sale.max' => 'Giá khuyến mãi không được lớn hơn 1000000000.00',
            'price_base.gt' => 'Giá gốc phải lớn hơn giá khuyến mãi',
            'service_start.after' => 'Ngày bắt đầu phải là một ngày sau ngày hôm qua',
            'service_end.after' => 'Ngày kết thúc phải là một ngày sau ngày bắt đầu',
            'title.required' => 'Vui lòng nhập trường này',
            'description.required' => 'Vui lòng nhập trường này',
            'service_start.required' => 'Vui lòng nhập trường này',
            'service_end.required' => 'Vui lòng nhập trường này',
            'status.required' => 'Vui lòng nhập trường này',
            'price_sale.required' => 'Vui lòng nhập trường này',
            'price_base.required' => 'Vui lòng nhập trường này',
        ];
    }
}
