<?php

namespace App\Models\Com;

use Illuminate\Database\Eloquent\Model;

class Sign extends Model
{
    protected $connection = 'com';
    protected $table = 'sign';

    public $timestamps = false;
    public $incrementing = false;
}
