<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Admin\Config
 *
 * @property string $name
 * @property string $value
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Config whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Config whereValue($value)
 * @mixin \Eloquent
 */
class Config extends Model
{
    protected $table = 'admin_config';
    protected $primaryKey = 'name';
    protected $guarded = [];

    public $timestamps = false;
    public $incrementing = false;
}
