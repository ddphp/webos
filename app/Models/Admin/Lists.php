<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Admin\Lists
 *
 * @property int $id
 * @property int $menu_id
 * @property string $name
 * @property string $icon
 * @property string $act
 * @property bool $sort
 * @property bool $gnum
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Admin\ListsChild[] $child
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Lists whereAct($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Lists whereGnum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Lists whereIcon($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Lists whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Lists whereMenuId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Lists whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Lists whereSort($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Admin\Menu $menu
 */
class Lists extends Model
{
    protected $table = 'admin_lists';

    public function child()
    {
        return $this->hasMany(ListsChild::class, 'list_id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}
