<?php

namespace App\Http\Controllers\Wx\User;

use App\Traits\Config;
use Ehd\Exceptions\MemberException;
use Ehd\Member;
use App\Models\Com\Sign as SignModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Sign extends Controller
{
    use Config;

    public function handle()
    {
        if (!\Session::has('member')) {
            return ['cod' => -1, 'msg' => '非法访问'];
        }

        $cardid = session('member.cardid');
        /** @var Member $member */
        $member = \App::make(Member::class);
        try {
            $member->wsdl(config('app.ehd.wsdl'))->where(['custid' => $cardid])->find();
        } catch (MemberException $e) {
            return ['cod' => -1, 'msg' => $e->getMessage()];
        }

        if ($member->getArchives('cardid')) {
            $id = date('Ymd').'@'.config('app.ehd.id');
            $sign = SignModel::find($id);
            if (!$sign) {
                $sign = app(SignModel::class);
                $sign->id = $id;
                $sign->date = date('Y-m-d', time());
                $sign->ehd_id = config('app.ehd.id');
                $sign->nums = 0;
                $data = [];
            } else {
                $data = unserialize($sign->data);
            }

            if (isset($data[$cardid])) {
                return ['cod' => -1, 'msg' => '今日已签到'];
            } else {
                // todo 事务处理
                $data[$cardid] = date('H:i:s', time());
                $sign->data = serialize($data);
                $sign->nums += 1;
                if ($sign->save()) {
                    $point = $this->config('sign.base', 'point', 10);
                    $member->adjustScore($point, '公众号签到赠送积分');  // return bool
                    session(['member.ehd' => $member->getArchives()]);
                    return [
                        'cod' => 0,
                        'msg' => '签到成功，积分+'.$point,
                        'dat' => $member->getArchives(['xsjf', 'fljf', 'totjf'])
                    ];
                } else {
                    return ['cod' => -1, 'msg' => '签到失败'];
                }
            }
        } else {
            return ['cod' => -1, 'msg' => '未绑定会员卡'];
        }
    }

    public function status($cardid)
    {

    }
}
