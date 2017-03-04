<?php
namespace App\Http\Controllers\Wx\User;

use App\Http\Controllers\Wx\Tools\CmdTrait;
use App\Http\Controllers\Wx\Tools\WxBindsTrait;
use Ehd\Exceptions\MemberException;
use Ehd\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Sms\Exceptions\SzrkException;
use Sms\Szrk;
use SMSCode\Verify;

/**
 * 已注册会员卡绑定
 */
class Bind extends Controller
{
    use CmdTrait;
    use WxBindsTrait;

    /**
     * 已注册会员卡绑定主页
     */
    public function index()
    {
        $head['title'] = '绑定已注册会员卡';

        return view('wx.user.bind', compact('head'));
    }

    /**
     * 读取用户输入会员卡的会员信息
     * @param Request $request
     * @param Member $member
     * @return array
     */
    public function fetchCardInfo(Request $request, Member $member)
    {
        $type   = $request->input('type');
        $number = $request->input('number');

        try {
            $member->wsdl(config('app.ehd.wsdl'))->where([$type => $number])->find();
            $cardid = $member->getArchives('cardid');
        } catch (MemberException $e) {
            return $this->cmd(-1, $e->getMessage());
        }

        // 卡号格式验证
        if (strlen($cardid) === 0) {
            return $this->cmd(-1, '请先输入卡号');
        }
        if (!preg_match('/^[1-9]\d{5,}$/',$cardid)) {
            return $this->cmd(-1, '卡号格式错误');
        }

        try {
            $member->wsdl(config('app.ehd.wsdl'))->where($cardid)->find();
            $archives = $member->getArchives('cardid', 'name', 'phone', 'personid');
            $archives['name'] = substr_replace($archives['name'], str_repeat('*', mb_strlen($archives['name'])-1), 3);
            $archives['phone'] = substr_replace($archives['phone'], '****', 3, 4);
            $archives['personid'] = substr_replace($archives['personid'], '********', 6, 8);
            return $this->cmd(0, $archives);
        } catch (MemberException $e) {
            return $this->cmd(-1, $e->getMessage());
        }
    }

    /**
     * 发送已注册会员卡绑定短信验证码
     *
     * @param Request $request
     * @param Szrk $szrk
     * @param Verify $verify
     * @param Member $member
     * @return array
     */
    public function sendSmsCode(Request $request, Szrk $szrk, Verify $verify, Member $member)
    {
        $openid = session('wechat.oauth_user.id');
        $cardid = $request->input('cardid');

        $phone = $member->wsdl(config('app.ehd.wsdl'))->where($cardid)->find()->getArchives('phone');

        $wxBinds = $this->getWxBinds($openid, $cardid);
        if ($wxBinds) {
            return $this->cmd(-1, '存在已绑定会员卡');
        }

        $code = $verify->setModel('sms_binds', 'openid', $openid)->setPhone($phone)->getCode();
        if ($code) {
            try {
                $szrk->account(config('app.sms.user'), config('app.sms.pass'))
                    ->sign(config('app.sms.sign'))
                    ->send($phone, sprintf(config('app.sms_code.bind'), $code));
                return $this->cmd(0, '发送成功');
            } catch (SzrkException $e) {
                return $this->cmd(-1, $e->getMessage());
            }
        } else {
            $error = $verify->getError();
            return $this->cmd(-1, $error->msg);
        }
    }

    /**
     * 提交会员卡绑定信息
     * @param Request $request
     * @param Member $member
     * @param Verify $verify
     * @return array
     */
    public function submit(Request $request, Member $member, Verify $verify)
    {
        $openid = session('wechat.oauth_user.id');
        $type   = $request->input('type');
        $number = $request->input('number');
        $code   = $request->input('smsCode');

        try {
            $member->wsdl(config('app.ehd.wsdl'))->where([$type => $number])->find();
            $cardid = $member->getArchives('cardid');
            $phone  = $member->getArchives('phone');
        } catch (MemberException $e) {
            return $this->cmd(-1, $e->getMessage());
        }

        $wxBinds = $this->getWxBinds($openid, $cardid);
        if ($wxBinds) {
            return $this->cmd(-1, '存在已绑定会员卡');
        }

        $check = $verify->setModel('sms_binds', 'openid', $openid)->setPhone($phone)->check($code);
        if ($check) {
            $add = $this->addWxBinds($openid, $cardid);
            if ($add) {
                return $this->cmd(0, '绑定成功');
            } else {
                return $this->cmd(-1, '会员卡绑定失败');
            }
        } else {
            $error = $verify->getError();
            return $this->cmd(-1, $error->msg);
        }
    }
}
