<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'name' => 'required',
            'title' => 'required',
            'description' => 'required',
            'image' => 'required | max:1024',
        ];
    }
    public function messages()
    {
        return[
            'name.required'=>'ادخل الاسم' ,
            'title.required'=>'ادخل العنوان',
            'description.required'=>'ادخل الوصف من فضلك',
            'image.max'=>'رجاء ادخال صوره مناسبه لا يزيد الحجم عن 1024 كيلو بايت ',
            'image.required'=>'رجاء ادخال صوره  '
        ];
    }
}
