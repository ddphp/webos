<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetUserRegistSmsCode extends FormRequest
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
            'mobilephone' => 'bail|required|digits:11|mobilephone'
        ];
    }

    public function messages()
    {
        return [
            'mobilephone.required' => '手机号码必须填写',
            'mobilephone.digits' => '手机号码必须为11位数字',
            'mobilephone.mobilephone' => '手机号码格式错误'
        ];
    }
}
