<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Account_Request extends FormRequest
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
            'email' => 'required',
            'password' => 'requierd|min:3'
        ];
    }
    public function messages()
    {
        return[
          'name'=>'name is requierd' ,
          'email'=>'email is requierd and not repeate',
          'password'=>'password is requierd and 6 characters'
        ];
    }
}
