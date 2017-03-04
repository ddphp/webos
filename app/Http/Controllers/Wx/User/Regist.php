<?php

namespace App\Http\Controllers\Wx\User;

use App\Http\Controllers\Wx\Tools\CmdTrait;
use App\Http\Controllers\Wx\Tools\WxBindsTrait;
use App\Http\Requests\GetUserRegistSmsCode;
use App\Http\Requests\UserRegistPost;
use Ehd\Exceptions\RegistException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Sms\Exceptions\SzrkException;
use Sms\Szrk;
use SMSCode\Verify;

/**
 * 注册并绑定新会员卡
 */
class Regist extends Controller
{
    use CmdTrait;
    use WxBindsTrait;

    /**
     * 注册并绑定新会员卡主页面
     */
    public function index()
    {
        $head['title'] = '注册并绑定新会员卡';

        return view('wx.user.regist', compact('head'));
    }

    /**
     * 获取注册会员卡短信验证码
     */
    public function getSmsCode(GetUserRegistSmsCode $request, Verify $verify, Szrk $szrk)
    {
        $openid = session('wechat.oauth_user.id');
        $phone  = $request->input('mobilephone');

        if (app(\Ehd\Member\Regist::class)->wsdl(config('app.ehd.wsdl'))->isExistField('custsjh', $phone))
        {
            return $this->cmd(-1, '该手机号已注册过会员卡');
        }

        $verify->setModel('sms_regist', 'openid', $openid)->setPhone($phone);
        $code = $verify->getCode();
        if ($code) {
            try {
                $szrk->account(config('app.sms.user'), config('app.sms.pass'))
                    ->sign(config('app.sms.sign'))
                    ->send($phone, sprintf(config('app.sms_code.regist'), $code));
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
     * 提交注册并绑定新会员卡
     */
    public function store(UserRegistPost $request, Verify $verify)
    {
        // input => mobilephone smscode name personid
        $openid   = session('wechat.oauth_user.id');
        $phone    = $request->input('mobilephone');
        $code     = $request->input('smscode');
        $name     = $request->input('name');
        $personid = $request->input('personid');

        // 验证短信验证码
        $verify->setModel('sms_regist', 'openid', $openid)->setPhone($phone);
        if(!$verify->check($code)) {
            $error = $verify->getError();
            return $this->cmd(-1, $error->msg);
        } else {
            // 绑定会员卡
            $errMsg = '';
            $cardid = $this->registMember($name, $phone, $personid, $errMsg);
            if ($cardid) {
                if ($this->addWxBinds($openid, $cardid)) {
                    return $this->cmd(0, '注册成功');
                } else {
                    return $this->cmd(-1, '会员卡绑定失败');
                }
            } else {
                return $this->cmd(-1, $errMsg);
            }
        }
    }

    /**
     * 会员卡绑定
     * @param string $name
     * @param string $phone
     * @param string $personid
     * @param string $errMsg
     * @return string|bool 成功返回新注册卡号，否则返回 False
     */
    private function registMember($name, $phone, $personid, &$errMsg)
    {
        try {
            $cardid = app(\Ehd\Member\Regist::class)
                ->wsdl(config('app.ehd.wsdl'))
                ->prefix(config('app.card.prefix'))
                ->figure(config('app.card.figure'))
                ->data($name, $phone, $personid)
                ->save(config('app.card.ycJf'));
            return $cardid;
        } catch (RegistException $registException) {
            $errMsg = $registException->getMessage();
            return false;
        }
    }
}
