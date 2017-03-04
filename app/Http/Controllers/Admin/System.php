<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class System extends Controller
{
    public function info()
    {
        $data['content'] = '名称：东大微信公众号管理系统 <br> 版本：0.0.1 <br> &copy; 东大购物中心';
        $data['options'] = [
            'title' => '系统信息'
        ];
        return $data;
    }

    public function user()
    {
        $user = session('admin.user.info');
        $data['content'] = "工号：{$user['USER_ID']} <br> 姓名：{$user['USER_NAME']} <br> 职务：{$user['USER_PRIV_NAME']}";
        $data['options'] = [
            'title' => '个人信息'
        ];
        return $data;
    }
}
