<?php
namespace Serv;


use App\Contracts\Voting\QueryPlayers as QueryPlayersContracts;
use App\Models\Voting\Players;

class QueryTpPlayers implements QueryPlayersContracts
{
    private $actid;
    private $page  = 1;
    private $take  = 10;
    private $query = [];

    private $tot;
    private $list;

    public function actid($id)
    {
        $this->actid = $id;

        return $this;
    }

    public function page($page)
    {
        $this->page = $page;

        return $this;
    }

    public function take($take)
    {
        $this->take = $take;

        return $this;
    }

    public function query($query)
    {
        $this->query = $query;

        return $this;
    }

    public function get(array $fields = [])
    {
        if (empty($fields)) {
            $fields = ['id', 'number', 'name', 'thumb', 'vote', 'openid'];
        }

        $list = Players::where('activity_id', $this->actid);

        $data = $this->query;
        $list = $list->where(function ($query) use ($data) {
            if (isset($data['number'])) {
                $query->where('number', 'like', "%{$data['number']}%");
            }
            if (isset($data['name'])) {
                $query->orWhere('name', 'like', "%{$data['name']}%");
            }
            return $query;
        });

        $this->tot = $list->count();

        $this->list = $list
            ->select($fields)
            ->orderBy('number')
            ->skip($this->take * ($this->page - 1))
            ->take($this->take)
            ->get();

        return $this;
    }

    public function getPage()
    {
        return [
            'tot' => ceil($this->tot/$this->take),
            'num' => count($this->list),
            'cur' => intval($this->page)
        ];
    }

    public function getList()
    {
        return $this->list;
    }

}