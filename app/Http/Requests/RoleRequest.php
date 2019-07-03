<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            'name' => 'required|unique:roles,name',
            'display_name' => 'required',
            'description' => 'required',
            'permission' => 'required',

        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'ادخل اسم القاعده',
            'display_name.required' => 'ادخل اسم ',
            'description.required' => 'ادخل وصف القاعده',
            'permission.required' => 'ادخل اسم القاعده',

        ];
    }
}
