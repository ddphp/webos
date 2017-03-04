<?php
namespace App\Http\Controllers\Wx\Tools;

/**
 * 微信会员卡绑定 Trait
 */
trait WxBindsTrait
{
    /**
     * 获取微信会员卡绑定数据
     * @param string $openid 公众号粉丝ID
     * @param string $cardid 绑定会员卡卡号
     * @return array|null|\stdClass
     */
    private function getWxBinds($openid, $cardid)
    {
        return \DB::table('wx_binds')->where('openid', $openid)->where('cardid', $cardid)->first();
    }

    /**
     * 添加微信会员卡绑定
     * @param string $openid 公众号粉丝ID
     * @param string $cardid 绑定会员卡卡号
     * @return bool
     */
    private function addWxBinds($openid, $cardid)
    {
        $time = date('Y-m-d H:i:s');
        return \DB::table('wx_binds')->insert([
            'openid' => $openid,
            'cardid' => $cardid,
            'created_at' => $time,
            'updated_at' => $time
        ]);
    }
}