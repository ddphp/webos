<?php

namespace App\Http\Controllers\Wx\User;

use App\Http\Controllers\Wx\Tools\CmdTrait;
use App\Http\Requests\EditUserInfoPost;
use Ehd\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * 绑定会员卡会员资料编辑
 */
class Edit extends Controller
{
use CmdTrait;

    /**
     * 会员信息编辑主页面
     */
    public function index()
    {
        $head['title'] = '修改个人信息';

        $member = session('member');
        $form = [
            'name'    => $member['ehd']['name'],
            'email'   => $member['ehd']['email'],
            'address' => $member['ehd']['address']
        ];

        return view('wx.user.edit', compact('head', 'form'));
    }

    /**
     * 会员信息修改提交保存
     * @param EditUserInfoPost $request
     * @param Member $member
     * @return array
     */
    public function store(EditUserInfoPost $request, Member $member)
    {
        // name address email
        $input = $request->input();
        // 亿惠达接口BUG，必须这样处理
        $input['cmpaddr'] = 'J'.$input['address'];
        unset($input['address']);

        try {
            $member->wsdl(config('app.ehd.wsdl'))->where(session('member.cardid'))->find();
            $member->changeArchives($input);
            return $this->cmd(0, '修改成功');
        } catch (\Exception $e) {
            return $this->cmd(-1, $e->getMessage());
        }

    }
}
