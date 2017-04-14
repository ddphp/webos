<?php

namespace App\Models\Voting;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Voting\ActivityContent
 *
 * @property int $id
 * @property int $activity_id
 * @property string $desc
 * @property string $detail
 * @property string $ext
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\ActivityContent whereActivityId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\ActivityContent whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\ActivityContent whereDesc($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\ActivityContent whereDetail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\ActivityContent whereExt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\ActivityContent whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\ActivityContent whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Voting\Activity $activity
 */
class ActivityContent extends Model
{
    protected $table = 'voting_activity_content';

    public function activity()
    {
        return $this->belongsTo(Activity::class, 'activity_id');
    }
}
