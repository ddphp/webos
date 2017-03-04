<?php

namespace App\Http\Controllers\Wx\User;

use EasyWeChat\Foundation\Application;
use App\Models\Com\Sign as SignModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * 会员卡中心
 */
class Main extends Controller
{
    /**
     * 会员卡中心主页面
     */
    public function index()
    {
        $head['title'] = '会员卡中心';

        $member = session('member');
        $js     = app(Application::class)->js;
        $axis   = explode(',', config('app.company.axis'));
        $map    = json_encode([
            'latitude' => $axis[0],
            'longitude' => $axis[1],
            'name' => config('app.company.name'),
            'address' => config('app.company.address')
        ]);

        // 签到
        $signState = false;
        $sign = SignModel::find(date('Ymd').'@'.config('app.ehd.id'));
        if ($sign) {
            $dat = unserialize($sign->data);
            $signState = isset($dat[$member['cardid']]);
        }

        return view('wx.user.index', compact('member', 'js', 'head', 'map', 'signState'));
    }

    /**
     * 绑定会员卡会员详情主页
     */
    public function detail()
    {
        $head['title'] = '查看个人信息';

        $js = app(Application::class)->js->config(['closeWindow']);

        $member = session('member');

        return view('wx.user.detail', compact('member', 'head', 'js'));
    }
}
