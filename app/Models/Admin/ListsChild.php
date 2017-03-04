<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Admin\ListsChild
 *
 * @property int $id
 * @property int $list_id
 * @property string $name
 * @property string $icon
 * @property string $act
 * @property bool $sort
 * @property bool $gnum
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ListsChild whereAct($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ListsChild whereGnum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ListsChild whereIcon($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ListsChild whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ListsChild whereListId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ListsChild whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\ListsChild whereSort($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Admin\Lists $list
 */
class ListsChild extends Model
{
    protected $table = 'admin_lists_child';

    public function list()
    {
        return $this->belongsTo(Lists::class, 'list_id');
    }
}
