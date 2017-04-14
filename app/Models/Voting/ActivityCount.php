<?php

namespace App\Models\Voting;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Voting\ActivityCount
 *
 * @property int $id
 * @property int $activity_id
 * @property int $players
 * @property int $voters
 * @property int $visitors
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\ActivityCount whereActivityId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\ActivityCount whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\ActivityCount whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\ActivityCount wherePlayers($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\ActivityCount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\ActivityCount whereVisitors($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\ActivityCount whereVoters($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Voting\Activity $activity
 */
class ActivityCount extends Model
{
    protected $table = 'voting_activity_count';

    public function activity()
    {
        return $this->belongsTo(Activity::class, 'activity_id');
    }
}
