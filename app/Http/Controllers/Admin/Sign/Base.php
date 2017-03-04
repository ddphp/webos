<?php

namespace App\Http\Controllers\Admin\Sign;

use App\Models\Admin\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Base extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = Config::findOrFail('sign.base');
    }

    public function index()
    {
        if ($this->model->value) {
            $form = $this->model->value;
        } else {
            $form = json_encode(['point'=>'']);
        }
        return view('admin.sign.base', compact('form'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'point' => 'bail|required|integer|between:0,100'
        ], [
            '*.required' => '必填项',
            '*.integer' => '必须为整数',
            'point.between' => '取值范围为0-100'
        ]);

        $value = json_encode($request->input());
        if ($value === $this->model->value) {
            return '没有数据变更';
        } else {
            $this->model->value = $value;
            return $this->model->save() ? '保存成功' : '保存失败';
        }
    }
}
