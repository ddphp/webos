<?php

namespace App\Http\Controllers\Voting;

use App\Models\Voting\Players;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Player extends Controller
{
    private $input;
    private $players;

    public function __construct(Request $request)
    {
        $this->input = new \stdClass();

        $this->input->actid = $request->input('actid', null);
        $this->input->page  = $request->input('page', 1);
        $this->input->take  = $request->input('take', 22);

        $this->input->query   = $request->input('query', '');
        $this->input->playids = $request->input('playids', []);

        if (isset($this->input->actid)) {
            $this->players = Players::where('activity_id', $this->input->actid)
                ->select(['id', 'number', 'name', 'thumb', 'vote', 'openid']);
        }
    }

    public function index()
    {
        return $this->players->page($this->input->page, $this->input->take)->orderBy('number')->get();
    }

    public function query()
    {
        $field = preg_match("/^[0-9]+$/", $this->input->query) ? 'number' : 'name';

        return $this->players->where($field, 'like', "%{$this->input->query}%")->get();
    }

    public function votes()
    {
        return Players::whereIn('id', $this->input->playids)->pluck('vote', 'id');
    }

    public function ranks()
    {
        return $this->players->orderBy('vote', 'desc')->page($this->input->page, $this->input->take)->get();
    }
}
