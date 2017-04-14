<?php

namespace App\Models\Voting;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Voting\VotersRecord
 *
 * @property int $id
 * @property int $voters_id
 * @property int $players_id
 * @property string $date
 * @property int $vote
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\VotersRecord whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\VotersRecord whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\VotersRecord whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\VotersRecord wherePlayersId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\VotersRecord whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\VotersRecord whereVote($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\VotersRecord whereVotersId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Voting\Players $player
 * @property-read \App\Models\Voting\Voters $voter
 */
class VotersRecord extends Model
{
    protected $table = 'voting_voters_record';

    public function voter()
    {
        return $this->belongsTo(Voters::class, 'voters_id');
    }

    public function player()
    {
        return $this->belongsTo(Players::class, 'players_id');
    }
}
