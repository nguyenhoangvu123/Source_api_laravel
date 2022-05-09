<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseFormRequest;

class AuthLoginRequest extends BaseFormRequest
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
            'email'         => 'required|email',
            'password'      => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.required'    => 'Vui lòng nhập email !',
            'email.email'       => 'Email không đúng định dạng !',

            'password.required' => 'Vui lòng nhập mật khẩu !'
        ];
    }
}
