<?php

namespace App\Models\Voting;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Voting\PlayersContent
 *
 * @property int $id
 * @property int $layers_id
 * @property string $desc
 * @property string $detail
 * @property string $ext
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\PlayersContent whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\PlayersContent whereDesc($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\PlayersContent whereDetail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\PlayersContent whereExt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\PlayersContent whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\PlayersContent whereLayersId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\PlayersContent whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $players_id
 * @property-read \App\Models\Voting\Players $player
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\PlayersContent wherePlayersId($value)
 */
class PlayersContent extends Model
{
    protected $table = 'voting_players_content';

    public function player()
    {
        return $this->belongsTo(Players::class, 'players_id');
    }
}
