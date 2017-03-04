<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\WxBind
 *
 * @property int $id
 * @property string $openid
 * @property string $cardid
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WxBind whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WxBind whereOpenid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WxBind whereCardid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WxBind whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WxBind whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class WxBind extends Model
{
    protected $table = 'wx_binds';
}
