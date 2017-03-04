<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MpBase extends FormRequest
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
            'app_id' => 'bail|required|string',
            'secret' => 'bail|required|string',
            'token' => 'bail|required|string|between:3,32',
            'aes_key' => 'bail|string|size:43'
        ];
    }

    public function messages()
    {
        return [
            'app_id.required' => 'AppId必须填写',
            'app_id.string' => 'AppId必须为字符串',
            'secret.required' => 'AppSecret必须填写',
            'secret.string' => 'AppSecret必须为字符串',
            'token.required' => 'Token必须填写',
            'token.string' => 'Token必须为字符串',
            'token.between' => 'Token长度为3到32位',
            'aes_key.string' => 'AES_KEY必须为字符串',
            'aes_key.size' => 'AES_KEY长度为43位'
        ];
    }
}
