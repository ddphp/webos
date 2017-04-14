<?php

namespace App\Models\Voting;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Voting\Voters
 *
 * @property int $id
 * @property int $activity_id
 * @property string $openid
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\Voters whereActivityId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\Voters whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\Voters whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\Voters whereOpenid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\Voters whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Voting\Activity $activity
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Voting\Players[] $players
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Voting\VotersRecord[] $votersRecord
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\Voters openid($openid, $activityId)
 */
class Voters extends Model
{
    protected $table = 'voting_voters';

    public function activity()
    {
        return $this->belongsTo(Activity::class, 'activity_id');
    }

    public function votersRecord()
    {
        return $this->hasMany(VotersRecord::class, 'voters_id');
    }

    public function players()
    {
        return $this->belongsToMany(Players::class, 'voting_voters_record', 'voters_id', 'players_id');
    }

    public function scopeOpenid($query, $openid, $activityId)
    {
        return $query->where('openid', $openid)->where('activity_id', $activityId);
    }
}
