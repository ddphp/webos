<?php

namespace App\Http\Controllers\Admin\Member;

use App\Models\Admin\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Verify extends Controller
{
    public function index()
    {
        $model = Config::find('member.verify');
        if ($model) {
            $form = $model->value;
        } else {
            $form = $this->fillFields(['bind','regist','length','interval','validity','fetch','verify']);
        }

        return view('admin.member.verify', compact('form'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'bind' => 'bail|required|string',
            'regist' => 'bail|required|string',
            'length' => 'bail|required|integer|between:4,8',
            'interval' => 'bail|required|integer|between:0,3600',
            'validity' => 'bail|required|integer|between:1,720',
            'fetch' => 'bail|required|integer|between:1,10',
            'verify' => 'bail|required|integer|between:1,10'
        ], [
            '*.required' => '必填项',
            '*.string' => '必须为字符串',
            '*.integer' => '必须为整数',
            'length.between' => '长度为4到8位',
            'interval.between' => '取值范围为0-3600',
            'validity.between' => '取值范围为1-720',
            'fetch.between' => '取值范围为1-10',
            'verify.between' => '取值范围为1-10',
        ]);

        $value = json_encode($request->input());

        $model = Config::find('member.verify');
        if ($model) {
            if ($model->value === $value) {
                return '没有数据变更';
            }
        } else {
            $model = new Config();
            $model->name = 'member.verify';
        }

        $model->value = $value;

        return $model->save() ? '保存成功' : '保存失败';
    }

    private function fillFields($fields)
    {
        return json_encode(array_combine($fields, array_fill(0, count($fields), '')));
    }
}
