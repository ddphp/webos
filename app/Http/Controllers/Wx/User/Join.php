<?php

namespace App\Http\Controllers\Wx\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * 会员卡绑定方式选择
 */
class Join extends Controller
{
    /**
     * 会员卡绑定方式选择主页面
     */
    public function index()
    {
        $head['title'] = '会员卡绑定';

        return view('wx.user.join', compact('head'));
    }
}
