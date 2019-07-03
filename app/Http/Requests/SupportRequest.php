<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupportRequest extends FormRequest
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
            'image' => 'image|mimes:jpg,png|max:10',
            'name' => 'requierd'

        ];
    }
    public function messages()
    {
        return [
            'image.max'=>'رجاء ادخال صوره مناسبه لا يزيد الحجم عن 1024 كيلو بايت ',
            'image.mimes'=>'رجاء ادخال صوره مناسبه ',
            'image.image'=>'رجاء اختر صوره  ',
            'name.requierd'=>'رجاء ادخل الاسم  ',

        ];
    }
}
