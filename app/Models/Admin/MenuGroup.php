<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Admin\MenuGroup
 *
 * @property int $id
 * @property string $name
 * @property bool $sort
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Admin\Menu[] $menu
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\MenuGroup whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\MenuGroup whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\MenuGroup whereSort($value)
 * @mixin \Eloquent
 */
class MenuGroup extends Model
{
    protected $table = 'admin_menu_group';

    public function menu()
    {
        return $this->hasMany(Menu::class, 'group_id');
    }
}
