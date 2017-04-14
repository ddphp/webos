<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Admin\Article
 *
 * @property int $id
 * @property string $name
 * @property string $content
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Article whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Article whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Article whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Article whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Article extends Model
{
    protected $table = 'admin_articles';
}
