<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Admin\Menu
 *
 * @property int $id
 * @property string $name
 * @property string $icon
 * @property int $group_id
 * @property bool $group_num
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Menu whereGroupId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Menu whereGroupNum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Menu whereIcon($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Menu whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Menu whereName($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Admin\MenuGroup $group
 */
class Menu extends Model
{
    protected $table = 'admin_menu';

    public function group()
    {
        return $this->belongsTo(MenuGroup::class, 'group_id');
    }
}
