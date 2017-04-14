<?php

namespace App\Http\Controllers\Voting;

use App\Events\Voting\VisitEvents;
use App\Models\Voting\Activity;
use App\Models\Voting\ActivityCount;
use App\Models\Voting\Players;
use App\Traits\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Index extends Controller
{
    use Config;

    private $activity;
    private $skin = 'default';

    public function __construct(Activity $activity)
    {
        config(['wechat' => $this->config('mp.base')]);
        $this->middleware('wechat.oauth')->only('index');

        $this->skin     = $activity->skin ?: 'default';
        $this->activity = $activity;
    }

    public function index()
    {
        config(['wechat' => $this->config('mp.base')]);
        $app = app('wechat');
        $js = $app->js;

        $openid   = session('wechat.oauth_user.id');

        $init = json_encode([
            'uri' => [
                'count'   => route('voting.count'),
                'players' => route('voting.players'),
                'query'   => route('voting.query'),
                'vote'    => route('voting.vote'),
                'votes'   => route('voting.votes')
            ],
            'dat' => [
                'actid'  => $this->activity->id,
                'take'   => 22,
                'openid' => $openid
            ]
        ]);

        event(new VisitEvents($this->activity, $openid));

        return $this->view("index.index", compact('init', 'js'));
    }

    public function player($activity, $number)
    {
        $player = Players::where('activity_id', $activity)
            ->where('number', $number)
            ->firstOrFail();

        $content = $player->playersContent;

        return $this->view('index.player', compact('player', 'content'));
    }

    public function rank($activity)
    {
        $actid = $activity;
        return $this->view("index.rank", compact('actid'));
    }

    public function detail()
    {
        return $this->view("index.detail");
    }

    public function count()
    {
        return $this->activity->activityCount()->select(['players', 'voters', 'visitors'])->first();
    }

    private function view($view, array $data = [])
    {
        return view("voting.{$this->skin}.{$view}", $data, ['activity' => $this->activity]);
    }

    // todo 剥离


}
