<?php

namespace App\Http\Controllers\Admin\Member;

use App\Models\Admin\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Sms extends Controller
{
    public function index()
    {
        $model = Config::find('member.sms');
        if ($model && $model->value) {
            $form = $model->value;
        } else {
            $form = json_encode(['user'=>'','pass'=>'','sign'=>'']);
        }

        return view('admin.member.sms', compact('form'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'user' => 'bail|required|string',
            'pass' => 'bail|required|string',
            'sign' => 'bail|required|string'
        ],[
            '*.required' => '必填项',
            '*.string' => '必须为字符串'
        ]);

        $model = Config::find('member.sms');
        if (!$model) {
            $model = new Config();
            $model->name = 'member.sms';
        }

        $value = json_encode($request->input());

        if ($model->value === $value) {
            return '没有数据变更';
        } else {
            $model->value = $value;
            if ($model->save()) {
                return '保存成功';
            } else {
                return '保存失败';
            }
        }
    }
}
