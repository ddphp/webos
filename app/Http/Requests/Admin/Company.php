<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class Company extends FormRequest
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
        $axis = '/^[0-9]+(\.[0-9]+)?,[0-9]+(\.[0-9]+)?$/';
        return [
            'name' => 'bail|required|string',
            'store' => 'bail|required|string',
            'logo' => 'bail|required|string',
            'axis' => ['bail', 'required', 'string', "regex:{$axis}"],
            'address' => 'bail|required|string',
            'tel' => 'bail|required|string'
        ];
    }

    public function messages()
    {
        return [
            '*.required' => '必填项',
            '*.string' => '必须为字符串',
            'axis.regex' => '坐标格式错误',
        ];
    }
}
