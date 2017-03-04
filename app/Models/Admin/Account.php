<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Admin\Account
 *
 * @property int $id
 * @property string $user
 * @property string $pass
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Account whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Account whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Account wherePass($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Account whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Account whereUser($value)
 * @mixin \Eloquent
 */
class Account extends Model
{
    protected $table = 'admin_accounts';
}
