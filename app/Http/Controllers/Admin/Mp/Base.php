<?php

namespace App\Http\Controllers\Admin\Mp;

use App\Http\Requests\Admin\MpBase;
use App\Models\Admin\Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Base extends Controller
{
    public function index(Request $request)
    {
        $configModel = Config::find('mp.base');
        if ($configModel && $configModel->value) {
            $config = $configModel->value;
        } else {
            $config = json_encode(['app_id'=>'', 'secret'=>'', 'token'=>'', 'aes_key'=>'']);
        }

        return view('admin.mp.base', compact('config'));
    }

    public function submit(MpBase $mpBase)
    {
        $value = json_encode($mpBase->input());
        $name  = 'mp.base';
        /** @var Model $model */
        $model = Config::find($name);
        if (!$model) {
            $model = new Config();
            $model->name = $name;
        }

        if ($model->value === $value) {
            return '没有数据被修改';
        }

        $model->value = $value;
        if ($model->save()) {
            return '保存成功';
        } else {
            return '保存失败';
        }
    }
}
