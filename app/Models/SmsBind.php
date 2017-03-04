<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SmsBind
 *
 * @property int $id
 * @property string $openid
 * @property string $phone
 * @property string $code
 * @property bool $sent_times
 * @property bool $verify_times
 * @property string $created_time
 * @property string $updated_time
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SmsBind whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SmsBind whereCreatedTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SmsBind whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SmsBind whereOpenid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SmsBind wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SmsBind whereSentTimes($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SmsBind whereUpdatedTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SmsBind whereVerifyTimes($value)
 * @mixin \Eloquent
 */
class SmsBind extends Model
{
    protected $table = 'sms_binds';
}
