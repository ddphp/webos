<?php

namespace App\Models\Voting;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Voting\Images
 *
 * @property int $id
 * @property string $md5
 * @property string $path
 * @property string $name
 * @property string $ext
 * @property string $mime
 * @property int $size
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\Images whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\Images whereExt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\Images whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\Images whereMd5($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\Images whereMime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\Images whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\Images wherePath($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\Images whereSize($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voting\Images whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Images extends Model
{
    protected $table = 'voting_images';
}
