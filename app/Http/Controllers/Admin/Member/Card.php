<?php

namespace App\Http\Controllers\Admin\Member;

use App\Models\Admin\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Card extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = Config::find('member.card');
    }
    public function index()
    {
        if ($this->model) {
            $form = $this->model->value;
        } else {
            $form = json_encode(['prefix'=>'','figure'=>'','ycJf'=>'']);
        }

        return view('admin.member.card', compact('form'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'prefix' => 'bail|required|string',
            'figure' => 'bail|required|integer|between:1,20',
            'ycJf' => 'bail|required|integer|between:1,200'
        ], [
            '*.required' => '必填项',
            '*.string' => '必须为字符串',
            '*.integer' => '必须为整数',
            'figure.between' => '取舍范围为1-20',
            'ycJf.between' => '取舍范围为1-200'
        ]);

        $value = json_encode($request->input());

        if (!$this->model) {
            $model = new Config();
            $model->name = 'member.card';
            $this->model = $model;
        } else {
            if ($this->model->value === $value) {
                return '没有数据变更';
            }
        }

        $this->model->value = $value;

        return $this->model->save() ? '保存成功' : '保存失败';
    }
}
