<?php

namespace App\Http\Controllers\Admin\Tp;

use App\Contracts\Voting\ManageImages;
use App\Contracts\Voting\QueryPlayers;
use App\Events\Voting\AddPlayer;
use App\Events\Voting\DelPlayer;
use App\Models\Voting\Activity;
use App\Models\Voting\Players;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Player extends Controller
{
    private $page;
    private $take;
    private $query;

    public function __construct(Request $request)
    {
        $this->initAttr($request);
    }

    public function index(QueryPlayers $query, $activity)
    {
        $players = $query->actid($activity)->page($this->page)->take($this->take);
        if (!empty($this->query)) {
            $players->query($this->query);
        }
        $players = $players->get();
        $page = $players->getPage();
        $list = $players->getList();
        $init = [
            'url' => [
                'query' => route('admin.tp.player', ['activity' => $activity])
            ],
            'activity' => $activity
        ];

        $data = compact('page', 'list');

        return \Request::ajax() ? $data : view('admin.tp.player.index', $data, compact('init'));
    }

    public function edit($activity, $player)
    {
        $fields = [
            'id' => null,
            'number' => '',
            'name' => '',
            'thumb' => '',
            'vote' => 0,
            'openid' => '',
            'activity_id' => $activity
        ];

        if ($player == '0') {
            $player = app(Players::class);
            foreach ($fields as $field => $default) {
                $player->$field = $default;
            }
        } else {
            $player = Players::select(array_keys($fields))->findOrFail($player);
        }

        return view('admin.tp.player.save', compact('player'));
    }

    public function save(Request $request, ManageImages $images, $activity, $player)
    {
        $data  = $request->except('id', 'i', 't', 'image');
        $image = $request->file('image');

        if ($image) {
            $image = $images->saveImage($image);
            $thumb = $images->getImageUrl($image, 280);
            $data['thumb'] = $thumb;
        }

        if ($player == '0') {
            $Player = app(Players::class);
        } else {
            $Player = Players::findOrFail($player);
        }

        foreach ($data as $key => $value) {
            $Player->$key = $value;
        }

        $Player->save();

        if ($player == '0') {
            event(new AddPlayer($Player));
        }

        $ret = $Player->toArray();
        unset($ret['created_at'], $ret['updated_at']);
        return $ret;
    }

    public function detail(Activity $activity, $number)
    {
        $player = $activity->players()->where('number', $number)->firstOrFail();
        $content = $player->playersContent;

        return view('admin.tp.player.detail', compact('player', 'activity', 'content'));
    }

    public function detailStore(Request $request,Activity $activity, $number)
    {
        $player = $activity->players()->where('number', $number)->firstOrFail();

        $content = $player->playersContent;

        $detail = trim($request->input('detail'));

        if ($content->detail == $detail) {
            return '数据未变更';
        }

        $content->detail = $detail;

        if ($content->save()) {
            return '保存成功';
        } else {
            return '保存失败';
        }
    }

    public function delete(Players $player)
    {
        $player->delete();
        event(new DelPlayer($player));
        return $player;
    }

    /**
     * 初始化属性值
     *
     * @param Request $request
     */
    private function initAttr(Request $request)
    {
        $this->page  = $request->input('page', 1);
        $this->take  = $request->input('take', 10);

        $number  = $request->input('number', '');
        $name    = $request->input('name', '');
        if ($number) {
            $this->query['number'] = $number;
        }
        if ($name) {
            $this->query['name'] = $name;
        }
    }
}
