<?php

namespace App\Models\Voting;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Voting\Activity
 *
 * @property int $id
 * @property string $name
 * @property string $banner
 * @property string $sdate
 * @property string $edate
 * @property bool $type
 * @property int $tot
 * @property int $num
 * @property int $vote
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Voting\ActivityCount $activityCount
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\Activity whereBanner($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\Activity whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\Activity whereEdate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\Activity whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\Activity whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\Activity whereNum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\Activity whereSdate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\Activity whereTot($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\Activity whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\Activity whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\Activity whereVote($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Voting\ActivityContent $activityContent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Voting\Players[] $players
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Voting\Voters[] $voters
 * @property string $skin
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\Activity whereSkin($value)
 */
class Activity extends Model
{
    protected $table = 'voting_activity';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function activityCount()
    {
        return $this->hasOne(ActivityCount::class, 'activity_id');
    }

    public function activityContent()
    {
        return $this->hasOne(ActivityContent::class, 'activity_id');
    }

    public function players()
    {
        return $this->hasMany(Players::class, 'activity_id');
    }

    public function voters()
    {
        return $this->hasMany(Voters::class, 'activity_id');
    }
}
