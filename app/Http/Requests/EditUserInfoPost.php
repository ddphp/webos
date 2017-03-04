<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUserInfoPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Session::has('member');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $zhCn = '/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u';
        // name email address
        return [
            'name'    => ['bail', 'required', 'between:2,8', "regex:{$zhCn}"],
            'email'   => 'bail|required|email',
            'address' => ['bail', 'required', 'max:40', "regex:{$zhCn}"]
        ];
    }

    public function messages()
    {
        return [
            'name.required'    => '姓名必须填写',
            'name.between'     => '姓名必须为2到8位长度',
            'name.regex'       => '姓名必须为中文、字母或者数字',
            'email.required'   => 'Email必须填写',
            'email.email'      => 'Email格式错误',
            'address.required' => '现居地不能为空',
            'address.max'      => '地址长度不能多于40个字符',
            'address.regex'    => '地址必须为中文、字母或者数字'
        ];
    }
}
