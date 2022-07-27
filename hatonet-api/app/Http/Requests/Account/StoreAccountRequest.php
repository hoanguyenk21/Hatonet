<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class StoreAccountRequest extends FormRequest
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
            'email'         => 'required|email|unique:users|max:100',
            'password'      => 'required|min:6|max:50',
            'name'          => 'required|max:100',
            'avatar'        => 'nullable|image:jpg,jpeg,png,svg,webp',
            'phone'         => 'required|phone:VN',
            'roles'         => 'required',
            'status'        => 'required',
            'parent_id'     => 'required',
        ];
    }

    public function messages()
    {
        return [
            'phone.phone' => 'Vui lòng nhập đúng số điện thoại',
            'required' => 'Không được để trống'
        ];
    }
}
