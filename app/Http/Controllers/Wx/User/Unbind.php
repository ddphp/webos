<?php

namespace App\Http\Controllers\Wx\User;

use App\Http\Controllers\Wx\Tools\CmdTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * 取消绑定会员卡
 */
class Unbind extends Controller
{
    use CmdTrait;

    /**
     * 取消绑定会员卡
     */
    public function handle() {
        if (!session('member')) {
            return $this->cmd(-1, '当前未登录');
        } else {
            $openid = session('member.openid');
            $cardid = session('member.cardid');

            $bindId = \DB::table('wx_binds')->where('openid', $openid)->where('cardid', $cardid)->value('id');
            if (!$bindId) {
                return $this->cmd(-1, '不存在的绑定用户');
            } else {
                $del = \DB::table('wx_binds')->delete($bindId);
                if ($del) {
                    return $this->cmd(0, '操作成功');
                } else {
                    return $this->cmd(-1, '取消绑定失败');
                }
            }
        }
    }
}
