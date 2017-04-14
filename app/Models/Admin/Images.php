<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Admin\Images
 *
 * @property int $id
 * @property string $sha1
 * @property string $file
 * @property string $ext
 * @property string $mime
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Images whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Images whereExt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Images whereFile($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Images whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Images whereMime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Images whereSha1($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Images whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Images extends Model
{
    protected $table = 'admin_images';
}
