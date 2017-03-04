<?php

namespace App\Http\Middleware;

use App\Models\WxBind;
use Closure;
use EasyWeChat\Foundation\Application;
use Ehd\Member;

class CheckWxBind
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     * @throws \Exception
     */
    public function handle($request, Closure $next, $status='yes')
    {
        if ($status === 'yes') {
            $wxBindRecord = WxBind::where('openid', session('wechat.oauth_user.id'))->first();
            if ($wxBindRecord) {
                if (!\Session::has('member')) {
                    session(['member' => $wxBindRecord->toArray()]);
                    // 获取绑定会员卡粉丝的会员信息
                    $ehd = app(Member::class)->wsdl(config('app.ehd.wsdl'))->where(session('member.cardid'))->find()->getArchives();
                    session(['member.ehd' => $ehd]);
                    // 获取绑定会员卡粉丝的微信信息
                    $user = app(Application::class)->user->get(session('member.openid'))->toArray();
                    session(['member.wx' => $user]);
                }
            } else {
                if (!$request->ajax()) {
                    return redirect()->route('wx.user.join');
                } else {
                    // 不作处理
                }
            }
        } else {
            if (\Session::has('member')) {
                if (!$request->ajax()) {
                    return redirect()->route('wx.user.index');
                } else {
                    // 不作处理
                }
            }
        }

        return $next($request);
    }
}
