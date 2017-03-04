<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegistPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Session::has('wechat.oauth_user');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $regexCn = '/^[\x{4e00}-\x{9fa5}]+$/u';
        return [
            'mobilephone' => 'bail|required|digits:11|mobilephone',
            'smscode' => 'bail|required|digits:4',
            'name' => ['bail', 'required', 'between:2,8', "regex:{$regexCn}"],
            'personid' => 'bail|required|size:18|personid'
        ];
    }

    public function messages()
    {
        return [
            'mobilephone.required' => '手机号必须填写',
            'mobilephone.digits' => '手机号必须为11位数字',
            'mobilephone.mobilephone' => '手机号格式错误',
            'smscode.required' => '短信验证码必须填写',
            'smscode.digits' => '短信验证码为4位数字',
            'name.required' => '姓名必须填写',
            'name.between' => '姓名长度为2到8位',
            'name.regex' => '姓名必须为中文',
            'personid.required' => '身份证号必须填写',
            'personid.size' => '身份证号码必须为18位长度',
            'personid.personid' => '身份证号码格式错误'
        ];
    }
}
