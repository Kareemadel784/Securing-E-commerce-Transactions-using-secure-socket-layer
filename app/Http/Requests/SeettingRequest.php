<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class SeettingRequest extends FormRequest
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
            'telephone' => 'required|numeric|regex:/(01)[0-9]{9}/',
            'facebook' => 'required',
            'twitter' => 'required',
            'email' => 'required|email',
        ];
    }
    public function messages()
    {
        return [
            'telephone.required' => 'ادخل رقم التليفون من فضلك ...',
            'twitter.required' => 'ادخل لينك تويتر ... ',
            'email.required' => 'ادخل البريد الالكتروني  ... ',
            'email.email' => 'ادخل بريد الكتروني صحيح  ... ',
            'facebook.required' => 'ادخل لينك الفيس بوك ... ',


        ];
    }
}
