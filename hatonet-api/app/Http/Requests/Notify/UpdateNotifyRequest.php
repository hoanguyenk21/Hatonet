<?php

namespace App\Http\Requests\Notify;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNotifyRequest extends FormRequest
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
            'description'  => 'nullable|max:320',
            'content'      => 'nullable',
            'type'         => 'string',
            'user_receive' => 'integer',
        ];
    }
}
