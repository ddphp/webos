<?php

namespace App\Models\Voting;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Voting\Players
 *
 * @property int $id
 * @property int $activity_id
 * @property int $number
 * @property string $name
 * @property string $thumb
 * @property int $vote
 * @property string $openid
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\Players whereActivityId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\Players whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\Players whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\Players whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\Players whereNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\Players whereOpenid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\Players whereThumb($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\Players whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\Players whereVote($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Voting\Activity $activity
 * @property-read \App\Models\Voting\PlayersContent $playersContent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Voting\Voters[] $voters
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Voting\VotersRecord[] $votersRecord
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\Players page($page, $take)
 */
class Players extends Model
{
    protected $table = 'voting_players';

    public function activity()
    {
        return $this->belongsTo(Activity::class, 'activity_id');
    }

    public function playersContent()
    {
        return $this->hasOne(PlayersContent::class, 'players_id');
    }

    public function votersRecord()
    {
        return $this->hasMany(VotersRecord::class, 'players_id');
    }

    public function voters()
    {
        return $this->belongsToMany(Voters::class, 'voting_voters_record', 'players_id', 'voters_id');
    }

    public function scopePage($query, $page, $take)
    {
        return $query->skip($take * ($page - 1))->take($take);
    }
}
