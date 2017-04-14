<?php

namespace App\Http\Controllers\Voting;

use App\Events\Voting\VoteEvents;
use App\Models\Voting\Players;
use App\Models\Voting\Voters;
use App\Models\Voting\VotersRecord;
use App\Traits\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Vote extends Controller
{
    use Config;

    private $voter;
    private $rule;
    private $record;
    /**
     * @var Players
     */
    private $player;

    private $currDate;

    private $error = [
        0 => '投票成功',
        1 => '活动期间限制',
        2 => '可投票选手数限制',
        3 => '可投票总数限制',
        4 => '选手可投票数限制',
        5 => '非法选手',
        6 => '投票失败',
        7 => '请先关注公众号',
        8 => '非法投票者'
    ];

    public function __construct(Request $request)
    {

    }

    public function handle(Request $request)
    {
        config(['wechat' => $this->config('mp.base')]);

        $this->currDate = date('Y-m-d', time());

        $openid     = $request->input('openid');
        $activityId = $request->input('actid');
        $playerId   = $request->input('playid');

        if ($openid !== session('wechat.oauth_user.id')) return $this->nm(8);

        // 判断 openid 合法性
        $wechat = app('wechat');
        $userService = $wechat->user;
        $user = $userService->get($openid);
        if ($user['subscribe'] == '0') {
            return $this->nm(7);
        }

        $this->voter  = $this->registVoter($openid, $activityId);
        $this->rule   = $this->getRule();  // 活动规则
        $this->record = $this->getRecord();  // 已投票记录
        $this->player = Players::findOrFail($playerId);

        if (!$this->status())       return $this->nm(1);
        if (!$this->validPlayer())  return $this->nm(5);

        $retNum = $this->validRecord();
        if ($retNum !== 0) return $this->nm($retNum);

        return $this->nm($this->vote());
    }

    private function vote()
    {
        $vote = VotersRecord::where([
            ['voters_id', '=', $this->voter->id],
            ['players_id', '=', $this->player->id],
            ['date', '=', $this->currDate]
        ])->first();
        if (!$vote) {
            $vote = app(VotersRecord::class);
            $vote->voters_id  = $this->voter->id;
            $vote->players_id = $this->player->id;
            $vote->date       = $this->currDate;
            $vote->vote       = 0;
        }

        $vote->vote ++;

        if ($vote->save()) {
            \DB::commit();
            event(new VoteEvents($this->voter, $this->player));
            return 0;
        } else {
            \DB::rollBack();
            return 6;
        }
    }

    private function validRecord()
    {
        if ($this->record) {
            if (isset($this->record[$this->player->id])) {
                if ($this->record[$this->player->id] >= $this->rule->vote) {
                    return 4;
                }

                if (count($this->record) > $this->rule->num) {
                    return 2;
                }
            } else {
                if (count($this->record) >= $this->rule->num) {
                    return 2;
                }
            }

            if (array_sum($this->record) >= $this->rule->tot) {
                return 3;
            }
        }

        return 0;
    }

    private function validPlayer()
    {
        return Players::findOrFail($this->player->id)->activity_id == $this->rule->id;
    }

    private function registVoter($openid, $activityId)
    {
        $voter = Voters::openid($openid, $activityId)->first();

        if (!$voter) {
            $voter = app(Voters::class);
            $voter->openid = $openid;
            $voter->activity_id = $activityId;
            $voter->save();
        }

        return $voter;
    }

    private function getRule()
    {
        return $this->voter->activity()->select([
            'id', 'sdate', 'edate', 'type', 'tot', 'num', 'vote'
        ])->firstOrFail();
    }

    private function getRecord()
    {
        $condition[] = ['voters_id', '=', $this->voter->id];

        if ($this->rule->type === 1) {
            $condition[] = ['date', '=', $this->currDate];
        }

        \DB::beginTransaction();  // 开启事务

        $records = VotersRecord::where($condition)->lockForUpdate()->get();

        return $this->formatRecord($records);
    }

    private function formatRecord($records)
    {
        $ret = [];

        if ($records) {
            foreach ($records as $record) {
                if (isset($ret[$record->players_id])) {
                    $ret[$record->players_id] += $record->vote;
                } else {
                    $ret[$record->players_id] = $record->vote;
                }
            }
        }

        return $ret;
    }

    private function status()
    {
        return $this->currDate >= $this->rule->sdate && $this->currDate <= $this->rule->edate;
    }

    private function nm($code)
    {
        return ['num' => $code, 'msg' => $this->error[$code]];
    }
}
