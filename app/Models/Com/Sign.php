<?php

namespace App\Models\Com;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Com\Sign
 *
 * @property string $id
 * @property string $date
 * @property string $ehd_id
 * @property string $data
 * @property int $nums
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Com\Sign whereData($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Com\Sign whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Com\Sign whereEhdId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Com\Sign whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Com\Sign whereNums($value)
 * @mixin \Eloquent
 */
class Sign extends Model
{
    protected $connection = 'com';
    protected $table = 'sign';

    public $timestamps = false;
    public $incrementing = false;
}
